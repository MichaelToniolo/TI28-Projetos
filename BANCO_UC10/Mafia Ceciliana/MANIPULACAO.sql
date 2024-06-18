-- INSERIR CLIENTE NA TABELA tb_cliente (COMPLETO)
INSERT INTO tb_cliente (cli_nome, cli_tel1, cli_tel2, cli_logradouro, cli_numero, cli_bairro)
VALUES ("Michael",16992530477, 16992530477, "Rua das Congongas Tricosvativuti", "80C", "Campos Eliseos");

INSERT INTO tb_cliente (cli_nome, cli_tel1, cli_logradouro, cli_numero, cli_bairro)
VALUES ("Victor", 169896565, "Rua do Victor", "900a", "Campos Elisios");

-- INSERIR CLIENTE NA TABELA tb_cliente (CURTO)
INSERT INTO tb_cliente (cli_nome, cli_tel1, cli_tel2, cli_logradouro, cli_numero, cli_bairro)
VALUES 
("Michael", 16992530477, 16992530477, "Rua das Congongas Tricosvativuti", "80C", "Campos Eliseos"),
("Rhavi", 169896565, 0, "Joao das Congongas", "900a", "Fortaleza"),
("Maria", 16123515, 129830912, "Rua 2", "399c", "Ipiranga");

-- PESQUISAR OU LER ALGUMA COISA DA TABELA

-- PESQUISA TUDO DA TABELA CLIENTE (*)
SELECT * FROM tb_cliente ;
SELECT cli_nome, cli_logradouro FROM tb_cliete WHERE cli_nome = "Rhavi";

-- FAZER UMA ALTERAÇÃO DE UM CLIENTE NA tb_cliente
UPDATE tb_cliente SET cli_nome="Michael Toniolo" WHERE cli_id = 12;

-- ESCREVI ERRADO VOU DELETAR
DELETE FROM tb_cliente WHERE cli_id = 1;


-- ALTERANDO ESTRUTURA DE UMA TABELA

-- ALTERA O DATATYPE DO pro_preco PARA ACEITAR 2 CASAS APÓS A VIRGULA
ALTER TABLE tb_produto MODIFY COLUMN pro_preco DECIMAL(10,2);

-- ADICIONANDO UMA NOVA COLUNA NA TABELA CLIENTE
ALTER TABLE tb_cliente ADD COLUMN cli_ativo CHAR(1) NOT NULL;
ALTER TABLE tb_cliente ADD COLUMN cli_email VARCHAR(100);

-- ADMINISTRANDO BANCO DE DADOS MYSQL

-- MOSTRAR TODAS AS BASES DE DADOS
SHOW DATABASES;

-- USAR A BASE DE DADOS
USE ceciliana;

-- MOSTRAR TABELAS EXISTENTES
SHOW TABLES;

-- DESCREVE COLUNAS EXISTENTES NA TABELA
DESC tb_produto;


-- PESQUISAS INFINITAS

-- TRAZ TUDO
SELECT * FROM tb_cliente;

-- TRAZ SOMENTE 2 CAMPOS
SELECT cli_nome, cli_tel1 FROM tb_cliente;

-- TRAZ SOMENTE 2 CAMPOS DE APENAS 1 USUARIO POR NOME
SELECT cli_nome, cli_tel2 FROM tb_cliente
WHERE cli_nome = "Maria";

-- PROMOÇÃO PARA O CAMPOS ELISEOS
SELECT * FROM tb_cliente
WHERE cli_bairro = "Campos Eliseos";

-- PESQUISA VENDAS
SELECT ven_id, cli_nome, pro_nome, ven_total FROM tb_venda
INNER JOIN tb_cliente ON fk_cli_id = cli_id 
INNER JOIN tb_produto ON fk_pro_id = pro_id
WHERE ven_total > 16;

-- VERIFICAÇÃO DE TAMANHO MAIOR MENOR
SELECT coluna_idade FROM nome_tabela WHERE coluna_idade >= 73;
SELECT coluna_idade, outra_coluna_que_quiser FROM nome_tabela WHERE coluna_idade <= 73;