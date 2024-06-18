-- RHAVI COMPRA UMA MARMITA M

SELECT cli_id, cli_nome FROM tb_cliente WHERE cli_nome = "Rhavi";
SELECT pro_id, pro_nome, pro_preco FROM tb_produto 
WHERE pro_nome = "Strogonoff de Carne  com Arroz e Batata Palha"
AND pro_tamanho = "M";

--GERANDO VENDA
INSERT INTO tb_venda (ven_data, ven_total, ven_quantidade, fk_cli_id, fk_pro_id)
VALUES ("2024-06-11-09:55", 15.00, 1, 2,1);