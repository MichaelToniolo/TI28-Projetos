CREATE DATABASE mafia;

USE mafia;

CREATE TABLE tb_usuarios(
    usu_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    usu_login VARCHAR(100) NOT NULL,
    usu_email VARCHAR(100) NOT NULL,
    usu_senha VARCHAR(100) NOT NULL,
    usu_status CHAR(1) NOT NULL
);

CREATE TABLE tb_clientes(
    cli_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cli_cpf VARCHAR(30) NULL,
    cli_nome VARCHAR(100) NOT NULL,
    cli_email VARCHAR(100),
    cli_cel VARCHAR(15),
    cli_status CHAR(1)
);

CREATE TABLE tb_produtos(
    pro_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pro_nome VARCHAR(100) NOT NULL,
    pro_quantidade DECIMAL(10,2),
    pro_unidade VARCHAR(10) NOT NULL,
    pro_preco DECIMAL(10,2) NOT NULL,
    pro_status CHAR(1) NOT NULL
);

CREATE TABLE tb_receitas(
    rec_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fk_pro_id INT NOT NULL
);

CREATE TABLE tb_ingredientes(
    ing_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ing_nome VARCHAR(100) NOT NULL,
    ing_unidade VARCHAR(10) NOT NULL,
    ing_quantidade DECIMAL(10,2) NOT NULL
);

CREATE TABLE tb_item_venda(
    iv_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    iv_valortotal DECIMAL(10,2) NOT NULL,
    iv_quantidade DECIMAL (10,2) NOT NULL,
    iv_cod_iv VARCHAR(100) NOT NULL,
    fk_cli_id INT NOT NULL,
    fk_pro_id INT NOT NULL
);

CREATE TABLE tb_venda(
    ven_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ven_datavenda DATETIME NOT NULL,
    ven_totalvenda DECIMAL(10,2) NOT NULL,
    fk_iv_cod_iv VARCHAR(100) NOT NULL,
    fk_cli_id INT NOT NULL,
    fk_usu_id INT NOT NULL
);


ALTER TABLE tb_receitas ADD CONSTRAINT rec_pro_id FOREIGN KEY (fk_pro_id) REFERENCES tb_produtos(pro_id);
ALTER TABLE tb_item_venda ADD CONSTRAINT iv_pro_id FOREIGN KEY (fk_pro_id) REFERENCES tb_produtos(pro_id);
ALTER TABLE tb_item_venda ADD CONSTRAINT iv_cli_id FOREIGN KEY (fk_cli_id) REFERENCES tb_clientes(cli_id);
ALTER TABLE tb_venda ADD CONSTRAINT ven_cli_id FOREIGN KEY (fk_cli_id) REFERENCES tb_clientes(cli_id);
ALTER TABLE tb_venda ADD CONSTRAINT ven_usu_id FOREIGN KEY (fk_usu_id) REFERENCES tb_usuarios(usu_id);


