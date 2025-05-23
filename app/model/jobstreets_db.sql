CREATE DATABASE IF NOT EXISTS jobstreets_db;

CREATE TABLE jobs (
    job_id INT(10) NOT NULL AUTO_INCREMENT,
    job-info VARCHAR(45),
    description VARCHAR(45),
    location VARCHAR(45),
    salary INT(11),
    PRIMARY KEY (job_id)
);