INSERT INTO categoria(nome, created) VALUES ('Colchões', NOW());
INSERT INTO categoria(nome, created) VALUES ('Camas', NOW());
INSERT INTO categoria(nome, created) VALUES ('Armários', NOW());
INSERT INTO categoria(nome, created) VALUES ('Cozinha', NOW());
INSERT INTO categoria(nome, created) VALUES ('Sala', NOW());

INSERT INTO fornecedor(nome, created) VALUES ('Casas Bahia', NOW());
INSERT INTO fornecedor(nome, created) VALUES ('Magazine Luiza', NOW());
INSERT INTO fornecedor(nome, created) VALUES ('Bariloche', NOW());
INSERT INTO fornecedor(nome, created) VALUES ('Móveis Modelo', NOW());
INSERT INTO fornecedor(nome, created) VALUES ('Bem Estar', NOW());

INSERT INTO produto(nome, informacao, detalhes, id_categoria, id_fornecedor, created, destaque, texto_destaque)
VALUES ('Colchão 1','Informações do colchão 1', 'Detalhes do colchão 1',6, 1, NOW(), 1, 'Colchão raríssimo 1');

INSERT INTO produto(nome, informacao, detalhes, id_categoria, id_fornecedor, created, destaque, texto_destaque)
VALUES ('Colchão 2','Informações do colchão 2', 'Detalhes do colchão 2',6, 1, NOW(), 2, 'Colchão raríssimo 2');

INSERT INTO produto(nome, informacao, detalhes, id_categoria, id_fornecedor, created, destaque, texto_destaque)
VALUES ('Colchão 3','Informações do colchão 3', 'Detalhes do colchão 3',7, 2, NOW(), 3, 'Colchão raríssimo 3');

INSERT INTO produto(nome, informacao, detalhes, id_categoria, id_fornecedor, created, destaque, texto_destaque)
VALUES ('Colchão 4','Informações do colchão 4', 'Detalhes do colchão 4',7, 2, NOW(), 4, 'Colchão raríssimo 4');


INSERT INTO produto(nome, informacao, detalhes, id_categoria, id_fornecedor, created, destaque, texto_destaque)
VALUES ('Cama Solteiro 1','Informações da cama 1', 'Detalhes da Cama 1',8, 3, NOW(), 3, 'Cama muito confortavel 1');