CREATE TABLE IF NOT EXISTS lock_types (
        type_id INT UNSIGNED NOT NULL,
        name VARCHAR(25),

        PRIMARY KEY(type_id)
        ) ENGINE=InnoDB;

INSERT INTO lock_types (type_id, name) VALUES ('1','IP');
INSERT INTO lock_types (type_id, name) VALUES ('2','UVUS');
INSERT INTO lock_types (type_id, name) VALUES ('3','Phishing');
INSERT INTO lock_types (type_id, name) VALUES ('4','Cloud');

CREATE TABLE IF NOT EXISTS locks (
        lock_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        type_id INT UNSIGNED NOT NULL,
        state INT UNSIGNED DEFAULT 1 NOT NULL,
        value VARCHAR(25) NOT NULL,
        owner VARCHAR(25) NOT NULL,
        comment VARCHAR (255),
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

