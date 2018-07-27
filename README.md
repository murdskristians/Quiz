    # Veidoja: Kristiāns Murds

    Instrukcija:
    Uz servera izveidot jaunu datubāzi un lietotāju ar šādiem parametriem.
        user = 'draugiemgroup'
        password = 'securepassword'
    -- phpMyAdmin version 4.7.4
    -- Host: 127.0.0.1:3306
    -- Server version: 5.7.19
    -- PHP Version: 7.1.9

    Importējam failu "ImportToDB.sql". 
    Pārvietojam visus failus uz servera un izmantojot interneta pārlūku atveram index.php failu.


    # --- Datubāze---

        - Dump fails : ImportToDB.sql
        - Lietotājs : Administrator
        - Parole: aj59&L1b$iW_&N
        - Hosts: localhost
        - Ports: default
        - Datubāzes nosaukums: DraugiemGroup

        Struktūra:
            users: glabā lietotāja vārdu, un piešķir id;
            tests: glabā testu nosaukumus un to id;
            questions: glabā jautājumu tekstus un id, kā arī atbilstošā testa id;
            answers: glabā atbilžu tekstu, id un vai tas ir pareizs, kā arī atbilstošā jautājuma id;
            user_answers: glabā katru atbildi, ko lietotājs izvēlas (atbildes id, jautājuma id, testa id, lietotāja id) un piešķir id;
            completed_tests: glabā lietotāja id, izpildītā testa id un pareizo atbilžu skaitu. piešķir ierakstam id.
