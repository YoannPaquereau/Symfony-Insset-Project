INSERT INTO appDB.user (id, username, roles, password, email, birthday, register_day, first_name, last_name, total_amount, last_order) VALUES (1, 'admin', '["ROLE_ADMIN"]', '$argon2id$v=19$m=65536,t=4,p=1$S4ooPgi084v30hLApPyCfA$qTMYwEtjdwrbxPXWKxE+qBLJu8RbBcRhftbMXxv2DhI', 'admin@gmail.com', '1998-03-24', '2020-02-05 09:52:31', 'admin', 'admin', 0.00, null);
INSERT INTO appDB.user (id, username, roles, password, email, birthday, register_day, first_name, last_name, total_amount, last_order) VALUES (2, 'Yoann', '[]', '$argon2id$v=19$m=65536,t=4,p=1$N9YcDOJ21w/SVMMFSDywGQ$0qpK493sTKNyX80jIv3HTHGs8MFbJH7iLh1vkNbMqB8', 'yoann.paquereau@gmail.com', '1998-03-24', '2020-02-29 14:38:22', 'Yoann', 'Paquereau', 0.00, null);

INSERT INTO appDB.product (id, name, description, price, stock, available, image_path) VALUES (101, 'Apple iPhone 11', 'Noir', 749.00, 10, 1, '5e5a8332c023f664336009.jpg');
INSERT INTO appDB.product (id, name, description, price, stock, available, image_path) VALUES (102, 'Samsung Galaxy S10', 'Noir Prisme', 649.00, 10, 1, '5e5a837ba21ae356428632.jpg');
INSERT INTO appDB.product (id, name, description, price, stock, available, image_path) VALUES (103, 'OnePlus 7 Pro', 'Gris Miroir', 599.00, 10, 1, '5e5a83c193b96855842684.jpg');
INSERT INTO appDB.product (id, name, description, price, stock, available, image_path) VALUES (104, 'Samsung Galaxy Fold', 'Argent', 2020.00, 0, 0, '5e5a842a3bc73834836183.jpg');
INSERT INTO appDB.product (id, name, description, price, stock, available, image_path) VALUES (105, 'Xiaomi Mi 9T', 'Carbon black', 279.00, 0, 1, '5e5a847c51604815592378.jpg');
INSERT INTO appDB.product (id, name, description, price, stock, available, image_path) VALUES (106, 'Apple Watch 3 GPS Alu', '38mm Bracelet Sport Noir', 300.00, 2, 1, '5e5a84e850eba978756161.jpg');
INSERT INTO appDB.product (id, name, description, price, stock, available, image_path) VALUES (107, 'Bose QuietComfort 35 II', 'Noir', 279.95, 3, 1, '5e5a854fa0bed970104739.jpg');
INSERT INTO appDB.product (id, name, description, price, stock, available, image_path) VALUES (108, 'Xiaomi Mi Smart Scale', 'Balance connectée
Blanc', 34.90, 5, 1, '5e5a85d7da0a8137153845.jpg');
INSERT INTO appDB.product (id, name, description, price, stock, available, image_path) VALUES (109, 'Huawei P30', 'Bleu Aurore', 425.00, 3, 1, '5e5a861fdaa9c974168925.jpg');
INSERT INTO appDB.product (id, name, description, price, stock, available, image_path) VALUES (110, 'Samsung Galaxy Note 10', 'Noir', 699.00, 10, 1, '5e5a864d5d8ca578367347.jpg');
INSERT INTO appDB.product (id, name, description, price, stock, available, image_path) VALUES (111, 'iPhone Xs', 'Gris sidéral
64Go', 679.00, 10, 1, '5e5a868ec1482748085948.jpg');
INSERT INTO appDB.product (id, name, description, price, stock, available, image_path) VALUES (112, 'Xiaomi Redmi Note 7', 'Noir', 160.00, 3, 1, '5e5a86b76163d669097663.jpg');
INSERT INTO appDB.product (id, name, description, price, stock, available, image_path) VALUES (113, 'iPhone 8 Plus', 'Gris Sidéral
64 Go', 519.00, 3, 1, '5e5a86f06e144848390446.jpg');
INSERT INTO appDB.product (id, name, description, price, stock, available, image_path) VALUES (114, 'Apple iPad Pro', '10.5 pouces
4G
256Go
Gris Sidéral', 1069.99, 2, 1, '5e5a87bc1efe6411214166.jpg');

