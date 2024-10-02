<?php
include("conectadb.php");

//SE NÃO PEGAR
//VÁ EM XAMPP/PHP/PHP.INI E TIRE O ';' DA FRENTE DE extension=gd E REINICIE O XAMPPINHO

// Incluindo a biblioteca PHPlot
require_once 'phplot-6.2.0/phplot.php';  // Certifique-se de que o caminho está correto

// Criando um objeto PHPlot e definindo o tamanho do gráfico (largura x altura)
$grafico = new PHPlot(600, 400);

// Definindo o título do gráfico
$grafico->SetTitle('GRAFICO DE VENDAS (SEM FILTRO FUNCIONAL AINDA(precisa de ajax))');

//Pega os dados 
$sql = "SELECT DATE(ven_datavenda), SUM(ven_totalvenda) FROM tb_venda
GROUP BY DATE(ven_datavenda) ORDER BY DATE(ven_datavenda)";

 $resultado = mysqli_query($link, $sql);

 $valortotal = "SELECT SUM(ven_totalvenda) FROM tb_venda"; 
 $retornovalortotal = mysqli_query($link, $valortotal);

//echo $sql;

// Dados para o gráfico (Mês, Temperatura)
// $dados = array(
//     array('Janeiro', 30),
//     array('Fevereiro', 32),
//     array('Março', 28),
//     array('Abril', 25),
//     array('Maio', 22),
//     array('Junho', 20),
//     array('Julho', 19),
//     array('Agosto', 21),
//     array('Setembro', 24),
//     array('Outubro', 27),
//     array('Novembro', 29),
//     array('Dezembro', 31)
// );

while ($tblcli = mysqli_fetch_array($resultado)) {
    //data está em $tblcli[0] e o valor está em $tblcli[1]
    $dados[] = array($tblcli[0], $tblcli[1]);
}

// Definindo os dados que serão utilizados no gráfico
$grafico->SetDataValues($dados);

// Definindo o tipo de gráfico (neste caso, um gráfico de linhas)
$grafico->SetPlotType('bars');
// $grafico->SetPlotType('lines'); // Para um gráfico de linhas
// $grafico->SetPlotType('bars'); // Para um gráfico de barras
// $grafico->SetPlotType('stackedbars'); // Para um gráfico de barras empilhadas
// $grafico->SetPlotType('stackedbarsh'); // Para um gráfico de barras horizontais empilhadas
// $grafico->SetPlotType('pie'); // Para um gráfico de pizza
// $grafico->SetPlotType('points'); // Para um gráfico de dispersão
// $grafico->SetPlotType('area'); // Para um gráfico de áreas
// $grafico->SetPlotType('stackedarea'); // Para um gráfico de áreas empilhadas
// $grafico->SetPlotType('box'); // Para um gráfico de caixa (boxplot)

// Definindo os rótulos dos eixos X e Y
$grafico->SetXTitle('Dias');
$grafico->SetYTitle('Valores');

// Opcional: Customizando a aparência do gráfico
$grafico->SetDataColors(array('#00FFFF'));  // Definindo a cor das linhas para azul
//$grafico->SetLineWidths(2);  // Definindo a espessura da linha

// Desenhando o gráfico
$grafico->DrawGraph();
?>
