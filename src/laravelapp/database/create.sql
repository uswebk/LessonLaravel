CREATE TABLE `people` (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	mail VARCHAR(255) ,
	age INT
);

INSERT INTO `people` VALUES(1,'a','a@example.jp',35);
INSERT INTO `people` VALUES(2,'b','b@example.jp',29);
INSERT INTO `people` VALUES(3,'c','c@example.jp',12);
INSERT INTO `people` VALUES(4,'d','d@example.jp',5);

CREATE TABLE `boards` (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	person_id INT,
	title VARCHAR(255) NOT NULL,
	message VARCHAR(255) NOT NULL,
	created_at datetime DEFAULT NULL,
	updated_at datetime DEFAULT NULL
);

