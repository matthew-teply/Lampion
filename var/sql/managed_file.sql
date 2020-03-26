CREATE TABLE managed_file (
    id int(11) not null PRIMARY KEY AUTO_INCREMENT,
    filename text not null,
    extension varchar(255) not null,
    description text not null,
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    changed TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    metadata text not null,
    tags text not null,
    uid varchar(255)
) CHAR SET 'utf8mb4';