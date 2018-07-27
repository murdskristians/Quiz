<?php

    class Queries extends databaseConnection
    {

        // Iegūst testu id un nosaukumus.
        public function getTests()
        {
            // Iegūst visus testus no datubāzes.
            $result = $this->connect()->query("SELECT * FROM tests");
            $num_rows = $result->num_rows;

            // Tālākās darbības notiks tad, ja eksistēs vismaz viens tests.
            if ($num_rows > 0)
            {
                while ($row = $result->fetch_assoc()) {
                    $datas[] = $row;
                }

                foreach ($datas as $data) {
                    $results[] = '<option value="'.$data['id'].'">' . $data['name'] . '</option>'."\r\n";
                }
                return $results;
            }
        }

        // Priekš testu lapas iegūst nosaukumu.
        public function testName($id)
        {
            $result = $this->connect()->query("SELECT * FROM tests WHERE id = ". $id);
            $num_rows = $result->num_rows;

            if ($num_rows > 0) 
            {
                while ($row = $result->fetch_assoc()) {
                    return $row['name'];
                }
            }
        }

        // Pārbaude vai datubāzē eksistē ievadītais lietotājs un atgriež tā id.
        public function checkUser($input)
        {
            // Vārdu salīdzināšana notiks, tos pārveidojot par mazajiem burtiem.
            $input_lower = mb_strtolower($input,'UTF-8');

            // Iegūst visus lietotājus no datubāzes.
            $result = $this->connect()->query("SELECT * FROM users");
            $num_rows = $result->num_rows;

            // Ja eksistē kaut viens lietotājs, tad notiks salīdzināšana.
            if ($num_rows > 0)
            {
                while ($row = $result->fetch_assoc()) {
                    $datas[] = $row;
                }

                foreach ($datas as $data) {
                    $name_lower =  mb_strtolower($data['name'],'UTF-8');

                    if ($name_lower == $input_lower) {
                        return $data['id'];
                    }
                }
                // Ja netika atrasts neviens lietotājs, tad atgriež 0.
                return 0;
            }
            // Ja neeksistē neviens lietotājs, tad izveido jaunu.
            else $id = $this->addUser($input);
            return $id;
        }

        // Pievieno datubāzei jaunu lietotāju un atgriež tā id.
        public function addUser($input)
        {
            $this->connect()->query("INSERT INTO users (name) VALUES ('".$input."')");

            $id = $this->checkUser($input);
            return $id;
        }

        // Iegūst lietotāja vārdu.
        public function getUserName($user_id) 
        {
            $result = $this->connect()->query("SELECT * FROM users WHERE id = ". $user_id);
            $num_rows = $result->num_rows;

            if ($num_rows > 0) 
            {
                while ($row = $result->fetch_assoc()) {
                    return $row['name'];
                }
            }
        }

        // Iegūst testam atbilstošos jautājumus.
        public function getQuestions($test_id)
        {
            $result = $this->connect()->query("SELECT * FROM questions WHERE test_id = ". $test_id);
            $num_rows = $result->num_rows;

            if ($num_rows > 0)
            {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;
            }
            return 0;
        }

        // Atbilstoši jautājumam iegūst atbildes.
        public function getAnswers($question_id)
        {
            $result = $this->connect()->query("SELECT * FROM answers WHERE question_id = ". $question_id);
            $num_rows = $result->num_rows;

            if ($num_rows > 0)
            {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;
            }
            return 0;
        }

        // Atbildot uz jautājumu, šo atbildi saglabā datubāzē.
        public function saveUserAnswer($user_id, $test_id, $question_id, $answer_id)
        {
            $this->connect()->query("INSERT INTO user_answers (user_id, test_id, question_id, answer_id) VALUES ('".$user_id."', '".$test_id."', '".$question_id."', '".$answer_id."')");
        }

        // Sagatavo testa izpildes rezultātu un ieraksta to datubāzē.
        public function completedTest($user_id, $test_id)
        {
            // Iegūst visus user_answers ierakstus, kur sakrīt lietotājs un tests.
            $result = $this->connect()->query("SELECT * FROM user_answers WHERE user_id = ". $user_id . " AND test_id = ". $test_id);
            $num_rows = $result->num_rows;

            if ($num_rows > 0)
            {
                while($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }

                // Saglabā visu atbilžu skaitu un pareizo atbilžu skaitu.
                $answerCount = 0;
                $correctCount = 0;

                // Iegūst visus answers ierakstus, kas atbilst jautājumam.
                foreach($data as $res) {
                    $result1 = $this->connect()->query("SELECT * FROM answers WHERE question_id = ". $res['question_id']);
                    $num_rows = $result1->num_rows;

                    if ($num_rows > 0)
                    {
                        while($row = $result->fetch_assoc()) {
                            $answers[] = $row;
                        }
        
                        // Pārbauda vai atbilde ir pareiza vai nepareiza un saskaita tās.
                        foreach($answers as $answer) {
                            if($answer['id'] == $res['answer_id']){
                                $answerCount++;
                                if($answer['is_correct'] == 1) {
                                    $correctCount++;
                                }
                                else continue;
                            }
                        }
                    }
                }

                // Ierakstam datubāzē lietotāja rezultātu.
                $this->connect()->query("INSERT INTO completed_tests (user_id, test_id, right_answers) VALUES ('".$user_id."', '".$test_id."', '".$correctCount."')");
            }
            return 0;
        }
    }
?>
