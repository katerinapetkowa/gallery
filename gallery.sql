CREATE DATABASE gallery;

USE gallery;

CREATE TABLE users (
    id int(11) not null AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(256) not null,
    last_name VARCHAR(256) not null,
    email VARCHAR(256) not null unique,
    username VARCHAR(256) not null unique,
    password VARCHAR(256) not null
    );
CREATE TABLE posts (
	id int(11) AUTO_INCREMENT PRIMARY KEY not null,
	description LONGTEXT not null,
	image_full_name LONGTEXT not null,
	upload_time TIMESTAMP,
	user_id int(11) not null,
	FOREIGN KEY (user_id) REFERENCES users(id)
);
CREATE TABLE hashtags (
	id int(11) AUTO_INCREMENT PRIMARY KEY not null,
	hashtag VARCHAR(256) not null
);
CREATE TABLE post_hashtag (
	post_id int(11) not null,
	hashtag_id int(11)  not null,
	PRIMARY KEY (post_id, hashtag_id),
	FOREIGN KEY (post_id) REFERENCES posts(id),
	FOREIGN KEY (hashtag_id) REFERENCES hashtags(id)
);