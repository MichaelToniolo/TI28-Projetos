-- CRUD - CREATE READ UPDATE DELETE

-- CRIA UMA BASE DE DADOS
CREATE DATABASE ceciliana;

-- SELECIONAR A BASE PARA OPERAR
USE ceciliana;

-- CRIAÇÃO DE TABELAS
CREATE TABLE tb_cliente(
    cli_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cli_nome VARCHAR(100) NOT NULL,
    cli_tel1 BIGINT NOT NULL,
    cli_tel2 BIGINT NULL,
    cli_logradouro VARCHAR(200) NOT NULL,
    cli_numero VARCHAR(20) NOT NULL,
    cli_bairro VARCHAR(100) NOT NULL,
    cli_ativo CHAR(1) NOT NULL,
    cli_email VARCHAR(100)
);

CREATE TABLE tb_produto(
    pro_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pro_nome VARCHAR(100) NOT NULL,
    pro_preco DECIMAL NULL,
    pro_tamanho CHAR(1) NOT NULL,
    pro_quantidade INT NULL
);

-- CREATE DA TABELA DE VENDAS
CREATE TABLE tb_venda(
    ven_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ven_data DATETIME NOT NULL,
    ven_total DECIMAL(10,2) NOT NULL,
    ven_quantidade INT NOT NULL,
    fk_cli_id INT NOT NULL,
    fk_pro_id INT NOT NULL
);

-- RELACIONAMENTOS

-- RELACIONAMENTO ENTRE TABELA tb_produto + tb_venda
ALTER TABLE tb_venda ADD CONSTRAINT tb_ven_pro FOREIGN KEY(fk_pro_id)
REFERENCES tb_produto(pro_id);

-- RELACIONAMENTO ENTRE TABLE tb_cliente + tb_venda
ALTER TABLE tb_venda ADD CONSTRAINT tb_ven_cli FOREIGN KEY (fk_cli_id)
REFERENCES tb_cliente(cli_id);