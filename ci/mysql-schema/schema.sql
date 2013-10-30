CREATE TABLE IF NOT EXISTS lock_types (
        type_id INT UNSIGNED NOT NULL,
        name VARCHAR(25),
        resource VARCHAR(25),
        icon VARCHAR(25),
        PRIMARY KEY(type_id)
        ) ENGINE=InnoDB;

INSERT INTO lock_types (type_id,name,resource,icon) VALUES (1,'ip','Dirección IP','globe');
INSERT INTO lock_types (type_id,name,resource,icon) VALUES (2,'user','Usuario','user');
INSERT INTO lock_types (type_id,name,resource,icon) VALUES (3,'phishing','Phishing','link');
INSERT INTO lock_types (type_id,name,resource,icon) VALUES (4,'hdd','Disco Virtual','hdd');

CREATE TABLE IF NOT EXISTS locks (
        lock_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        type_id INT UNSIGNED NOT NULL,
        state INT UNSIGNED DEFAULT 1 NOT NULL,
        subtype VARCHAR(50),
        value VARCHAR(100) NOT NULL,
        owner VARCHAR(25) NOT NULL,
        comment VARCHAR (255),
        birth_date INT NOT NULL,        
        date INT NOT NULL,
        lock_counter INT DEFAULT 1 NOT NULL,

        INDEX(type_id),
        INDEX(state),
        INDEX(value),
        INDEX(date),

        UNIQUE(value,type_id),

        PRIMARY KEY(lock_id), 

        FOREIGN KEY(type_id) REFERENCES lock_types(type_id)
        ON DELETE CASCADE
        ) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS logs (
        log_id INT UNSIGNED NOT NULL,
        date INT NOT NULL,
        owner VARCHAR(25) NOT NULL,
        description VARCHAR(200),
        type ENUM('users','auto') NOT NULL,
        PRIMARY KEY(log_id)
        ) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `ci_sessions` (
        session_id varchar(40) DEFAULT '0' NOT NULL,
        session_start int(10) unsigned DEFAULT 0 NOT NULL,
        session_last_activity int(10) unsigned DEFAULT 0 NOT NULL,
        session_ip_address varchar(16) DEFAULT '0' NOT NULL,
        session_user_agent varchar(50) NOT NULL,
        session_data text default '' NOT NULL,

        PRIMARY KEY (session_id)
        );