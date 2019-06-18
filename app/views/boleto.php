<?php
    require '../database.php';
    if (! isset($_GET['id'])) exit;
    $boleto_id_hash = $_GET['id'];
    $boleto = get("SELECT * FROM boleto_cliente WHERE md5(id) = '{$boleto_id_hash}'")[0];
    if (count($boleto) == 0) exit;
    $boleto['cliente'] = get("SELECT * FROM cliente WHERE id = {$boleto['cliente_id']}")[0];
    if (count($boleto['cliente']) == 0) exit;
    $boleto['nosso_numero'] = hexdec(crc32($boleto['id']));
    $data['linha_digitavel'] = '10496.21632 90000.200049 00008.912479 1 6882000001'.str_replace('.', '', $boleto['valor']);
?>

<html>
<head>
    <title>BOLETO</title>
    <!-- <link rel="icon" href="/locashow/assets/favicon.ico" type="image/x-icon"> -->
    <link rel="stylesheet" type="text/css" href="/locashow/css/boleto.css?v=<?php echo date('YmdHis'); ?>">
</head>
<body>

<table cellSpacing=0 cellPadding=0 border=0 class=Boleto>
    <tr>
        <td style="width: 0.9cm"></td>
        <td style="width: 1cm"></td>
        <td style="width: 1.9cm"></td>
        <td style="width: 0.5cm"></td>
        <td style="width: 1.3cm"></td>
        <td style="width: 0.8cm"></td>
        <td style="width: 1cm"></td>
        <td style="width: 1.9cm"></td>
        <td style="width: 1.9cm"></td>
        <td style="width: 3.8cm"></td>
        <td style="width: 3.8cm"></td>
    <tr>
        <td colspan=11>
            <ul class=BoletoInstrucoes>
                <li>Imprima em papel A4 ou Carta</li>
                <li>Utilize margens mínimas a direita e a esquerda</li>
                <li>Recorte na linha pontilhada</li>
                <li>Não rasure o código de barras</li>
            </ul>
        </td>
    </tr>
    </tr>
    <tr>
        <td colspan=11 class=BoletoPontilhado>&nbsp;</td>
    </tr>
    <tr>
        <td colspan=4 class=BoletoLogo><img src="/locashow/assets/logo-banco.jpg"></td>
        <td colspan=2 class=BoletoCodigoBanco>104-0</td>
        <td colspan=6 class=BoletoLinhaDigitavel><?php echo $data['linha_digitavel']; ?></td>
    </tr>
    <tr>
        <td colspan=10 class=BoletoTituloEsquerdo>Local de Pagamento</td>
        <td class=BoletoTituloDireito>Vencimento</td>
    </tr>
    <tr>
        <td colspan=10 class=BoletoValorEsquerdo style="text-align: left; padding-left : 0.1cm">PAGAR PREFERENCIALMENTE NO BANCO CAIXA</td>
        <td class=BoletoValorDireito><?php echo date('d/m/Y', strtotime($boleto['dt_vencimento'])); ?></td>
    </tr>  
    <tr>
        <td colspan=10 class=BoletoTituloEsquerdo>Cedente</td>
        <td class=BoletoTituloDireito>Agência/Código do Cedente</td>
    </tr>
    <tr>
        <td colspan=10 class=BoletoValorEsquerdo style="text-align: left; padding-left : 0.1cm">LOCASHOW LTDA</td>
        <td class=BoletoValorDireito>---</td>
    </tr>   
    <tr>
        <td colspan=3 class=BoletoTituloEsquerdo>Data do Documento</td>
        <td colspan=4 class=BoletoTituloEsquerdo>Número do Documento</td>
        <td class=BoletoTituloEsquerdo>Espécie</td>
        <td class=BoletoTituloEsquerdo>Aceite</td>
        <td class=BoletoTituloEsquerdo>Data do Processamento</td>
        <td class=BoletoTituloDireito>Nosso Número</td>
    </tr>
    <tr>
        <td colspan=3 class=BoletoValorEsquerdo><?php echo date('d/m/Y', strtotime($boleto['created_at'])); ?></td>
        <td colspan=4 class=BoletoValorEsquerdo><?php echo $boleto['nosso_numero']; ?></td>
        <td class=BoletoValorEsquerdo>RC</td>
        <td class=BoletoValorEsquerdo>N</td>
        <td class=BoletoValorEsquerdo><?php echo date('d/m/Y', strtotime(date('Ymd'))); ?></td>
        <td class=BoletoValorDireito><?php echo $boleto['nosso_numero']; ?></td>
    </tr>  
    <tr>
        <td colspan=3 class=BoletoTituloEsquerdo>Uso do Banco</td>
        <td colspan=2 class=BoletoTituloEsquerdo>Carteira</td>
        <td colspan=2 class=BoletoTituloEsquerdo>Moeda</td>
        <td colspan=2 class=BoletoTituloEsquerdo>Quantidade</td>
        <td class=BoletoTituloEsquerdo>(x) Valor</td>
        <td class=BoletoTituloDireito>(=) Valor do Documento</td>
    </tr>
    <tr>
        <td colspan=3 class=BoletoValorEsquerdo>&nbsp;</td>
        <td colspan=2 class=BoletoValorEsquerdo>SR</td>
        <td colspan=2 class=BoletoValorEsquerdo>R$</td>
        <td colspan=2 class=BoletoValorEsquerdo>&nbsp;</td>
        <td class=BoletoValorEsquerdo>&nbsp;</td>
        <td class=BoletoValorDireito><?php echo number_format($boleto['valor'], 2, ',', '.'); ?></td>
    </tr>  
    <tr>
        <td colspan=10 class=BoletoTituloEsquerdo>Instrucões</td>
        <td class=BoletoTituloDireito>(-) Desconto</td>
    </tr>
    <tr>
        <td colspan=10 rowspan=9 class=BoletoValorEsquerdo style="text-align: left; vertical-align:top; padding-left : 0.1cm">
        Sr. Caixa:<br>
        1) Não aceitar pagamento em cheque;<br>
        2) Não aceitar mais de um pagamento com o mesmo boleto;<br>
        3) Em caso de vencimento no fim de semana ou feriado, aceitar o pagamento até o primeiro dia útil após o vencimento.<br>
        </td>
        <td class=BoletoValorDireito>&nbsp;</td>
    </tr>  
    <tr>
        <td class=BoletoTituloDireito>(-) Outras Deduções/Abatimento</td>
    </tr>  
    <tr>
        <td class=BoletoValorDireito>&nbsp;</td>
    </tr>  
    <tr>
        <td class=BoletoTituloDireito>(+) Mora/Multa/Juros</td>
    </tr>  
    <tr>
        <td class=BoletoValorDireito>&nbsp;</td>
    </tr>  
    <tr>
        <td class=BoletoTituloDireito>(+) Outros Acréscimos</td>
    </tr>  
    <tr>
        <td class=BoletoValorDireito>&nbsp;</td>
    </tr>  
    <tr>
        <td class=BoletoTituloDireito>(=) Valor Cobrado</td>
    </tr>  
    <tr>
        <td class=BoletoValorDireito>&nbsp;</td>
    </tr>                
    <tr>
        <td rowspan=3 Class=BoletoTituloSacado>Sacado:</td>
        <td colspan=8 Class=BoletoValorSacado><?php echo $boleto['cliente']['nome']; ?></td>
        <td colspan=2 Class=BoletoValorSacado><?php echo $boleto['cliente']['cpf_cnpj']; ?></td>
    </tr> 
    <tr>
        <td colspan=10 Class=BoletoValorSacado></td>
    </tr>
    <tr>
        <td colspan=10 Class=BoletoValorSacado></td>
    </tr>  
    <tr>
        <td colspan=2 Class=BoletoTituloSacador>Sacador / Avalista:</td>
        <td colspan=9 Class=BoletoValorSacador></td>
    </tr>
    <tr>
        <td colspan=11 class=BoletoTituloDireito style="text-align: right; padding-right: 0.1cm">Recibo do Sacado - Autenticação Mecânica</td>
    </tr>
    <tr>
        <td colspan=11 height=60 valign=top>&nbsp</td>
    </tr>
    <tr><td colspan=11 class=BoletoPontilhado>&nbsp;</td></tr>  
    <tr>
        <td colspan=4 class=BoletoLogo><img src="/locashow/assets/logo-banco.jpg"></td>
        <td colspan=2 class=BoletoCodigoBanco>104-0</td>
        <td colspan=6 class=BoletoLinhaDigitavel><?php echo $data['linha_digitavel']; ?></td>
    </tr>
    <tr>
        <td colspan=10 class=BoletoTituloEsquerdo>Local de Pagamento</td>
        <td class=BoletoTituloDireito>Vencimento</td>
    </tr>
    <tr>
        <td colspan=10 class=BoletoValorEsquerdo style="text-align: left; padding-left : 0.1cm">PAGAR PREFERENCIALMENTE NO BANCO CAIXA</td>
        <td class=BoletoValorDireito>Vencimento</td>
    </tr>  
    <tr>
        <td colspan=10 class=BoletoTituloEsquerdo>Cedente</td>
        <td class=BoletoTituloDireito>Agência/Código do Cedente</td>
    </tr>
    <tr>
        <td colspan=10 class=BoletoValorEsquerdo style="text-align: left; padding-left : 0.1cm">LOCASHOW LTDA</td>
        <td class=BoletoValorDireito>---</td>
    </tr>   
    <tr>
        <td colspan=3 class=BoletoTituloEsquerdo>Data do Documento</td>
        <td colspan=4 class=BoletoTituloEsquerdo>Número do Documento</td>
        <td class=BoletoTituloEsquerdo>Espécie</td>
        <td class=BoletoTituloEsquerdo>Aceite</td>
        <td class=BoletoTituloEsquerdo>Data do Processamento</td>
        <td class=BoletoTituloDireito>Nosso Número</td>
    </tr>
    <tr>
        <td colspan=3 class=BoletoValorEsquerdo><?php echo date('d/m/Y', strtotime($boleto['created_at'])); ?></td>
        <td colspan=4 class=BoletoValorEsquerdo><?php echo $boleto['nosso_numero']; ?></td>
        <td class=BoletoValorEsquerdo>RC</td>
        <td class=BoletoValorEsquerdo>N</td>
        <td class=BoletoValorEsquerdo><?php echo date('d/m/Y', strtotime(date('Ymd'))); ?></td>
        <td class=BoletoValorDireito><?php echo $boleto['nosso_numero']; ?></td>
    </tr>  
    <tr>
        <td colspan=3 class=BoletoTituloEsquerdo>Uso do Banco</td>
        <td colspan=2 class=BoletoTituloEsquerdo>Carteira</td>
        <td colspan=2 class=BoletoTituloEsquerdo>Moeda</td>
        <td colspan=2 class=BoletoTituloEsquerdo>Quantidade</td>
        <td class=BoletoTituloEsquerdo>(x) Valor</td>
        <td class=BoletoTituloDireito>(=) Valor do Documento</td>
    </tr>
    <tr>
        <td colspan=3 class=BoletoValorEsquerdo>&nbsp;</td>
        <td colspan=2 class=BoletoValorEsquerdo>SR</td>
        <td colspan=2 class=BoletoValorEsquerdo>R$</td>
        <td colspan=2 class=BoletoValorEsquerdo>&nbsp;</td>
        <td class=BoletoValorEsquerdo>&nbsp;</td>
        <td class=BoletoValorDireito><?php echo number_format($boleto['valor'], 2, ',', '.'); ?></td>
    </tr>  
    <tr>
        <td colspan=10 class=BoletoTituloEsquerdo>Instrucões</td>
        <td class=BoletoTituloDireito>(-) Desconto</td>
    </tr>
    <tr>
        <td colspan=10 rowspan=9 class=BoletoValorEsquerdo style="text-align: left; vertical-align:top; padding-left : 0.1cm">
        Sr. Caixa:<br>
        1) Não aceitar pagamento em cheque;<br>
        2) Não aceitar mais de um pagamento com o mesmo boleto;<br>
        3) Em caso de vencimento no fim de semana ou feriado, aceitar o pagamento até o primeiro dia útil após o vencimento.<br>
        </td>
        <td class=BoletoValorDireito>&nbsp;</td>
    </tr>  
    <tr>
        <td class=BoletoTituloDireito>(-) Outras Deduções/Abatimento</td>
    </tr>  
    <tr>
        <td class=BoletoValorDireito>&nbsp;</td>
    </tr>  
    <tr>
        <td class=BoletoTituloDireito>(+) Mora/Multa/Juros</td>
    </tr>  
    <tr>
        <td class=BoletoValorDireito>&nbsp;</td>
    </tr>  
    <tr>
        <td class=BoletoTituloDireito>(+) Outros Acréscimos</td>
    </tr>  
    <tr>
        <td class=BoletoValorDireito>&nbsp;</td>
    </tr>  
    <tr>
        <td class=BoletoTituloDireito>(=) Valor Cobrado</td>
    </tr>  
    <tr>
        <td class=BoletoValorDireito>&nbsp;</td>
    </tr>                
    <tr>
        <td rowspan=3 Class=BoletoTituloSacado>Sacado:</td>
        <td colspan=8 Class=BoletoValorSacado><?php echo $boleto['cliente']['nome']; ?></td>
        <td colspan=2 Class=BoletoValorSacado><?php echo $boleto['cliente']['cpf_cnpj']; ?></td>
    </tr> 
    <tr>
        <td colspan=10 Class=BoletoValorSacado></td>
    </tr>
    <tr>
        <td colspan=10 Class=BoletoValorSacado></td>
    </tr>  
    <tr>
        <td colspan=2 Class=BoletoTituloSacador>Sacador / Avalista:</td>
        <td colspan=9 Class=BoletoValorSacador></td>
    </tr>
    <tr>
        <td colspan=11 class=BoletoTituloDireito style="text-align: right; padding-right: 0.1cm">Ficha de Compensação - Autenticação Mecânica</td>
    </tr>
    <tr>
        <td colspan=11 height=60 valign=top><img src="/locashow/assets/codbar.jpg"></td>
    </tr>
    <tr>
        <td colspan=11 class=BoletoPontilhado>&nbsp;</td>
    </tr>  
</table>

</body>
</html>