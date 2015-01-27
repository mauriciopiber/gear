INSERT INTO role(id_role, id_parent, name, created) VALUES ('guest', null, 'guest', NOW());
INSERT INTO role(id_role, id_parent, name, created) VALUES ('admin', 'guest', 'admin', NOW());