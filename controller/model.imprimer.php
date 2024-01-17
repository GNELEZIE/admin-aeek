<style type="text/css">
    table {
        width: 100%;
        color: #515355;
        font-family: helvetica;
        line-height: 2.5mm;
        border-collapse: collapse;
    }
    h2 {
        margin: 0;
        padding: 0;
    }
    p {
        margin: 5px;
    }
    .border th {
        padding: 10px;
        font-size: 14px;
        text-align: center;
        color: #67748e;
    }


    .10p { width: 10%; } .15p { width: 15%; }
    .20p { width: 20%; } .25p { width: 25%; }
    .30p { width: 30%; } .35p { width: 35%; }
    .40p { width: 40%; } .50p { width: 50%; }
    .60p { width: 60%; } .65p { width: 65%; }
    .70p { width: 70%; } .75p { width: 75%; }
    .17p { width: 17%; } .3p { width: 3%; }
    .80p { width: 80%; }
    .100p { width: 100%; }

    thead tr th{
        border : 1px solid #67748e;
    }

    tr td.no-border1{
        padding: 5px;
        font-size: 13px;
        border : 1px solid #67748e;
        border-right: none !important;
    }

    tr td.no-border2 {
        padding: 5px;
        font-size: 13px;
        border : 1px solid #67748e;
        border-left: none !important;
        border-right: none !important;
    }
    tr td.no-border3 {
        padding: 5px;
        font-size: 13px;
        border : 1px solid #67748e;
    }
    tr.yborder  td{
        padding: 5px;
        font-size: 13px;
        border : 1px solid #67748e;
    }

    .title{
        padding-left: 20px;
        font-size: 30px;
        line-height: 1.5;
        padding-top: 50px;
    }
    .line-h{
        line-height: 1.3;
    }
    tbody tr td{
        text-align: center;
    }


</style>

<page backtop="15mm" backbottom="15mm" backleft="16mm" backright="16mm">
    <page_header>
        <table>
            <tr>
                <td class="100p">
                   <h1 style="text-align: center">La liste des inscrits pour AEEK PLUME</h1>
                </td>
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table class="page_footer">
            <tr>
                <td class="text-blue" style="width: 100%; font-size: 10px">
                    <div style="width: 100%; text-align: center">
                    </div>
                    <div style="width: 100%; text-align: right">
                        Page [[page_cu]]/[[page_nb]]
                    </div>
                </td>
            </tr>
        </table>
    </page_footer>


    <table style="margin-top: 30px;" class="border">
        <thead>
        <tr>
            <th class="10p" style="">N°</th>
            <th class="30p" style="">Date de création</th>
            <th class="30p">Nom & prénom</th>
            <th class="30p" style="">Téléphone</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $nu = 0;
        while($datas = $liste->fetch()) {
            $nu++;
            $nom = html_entity_decode(htmlentities($datas["nom"])).' '.html_entity_decode(htmlentities($datas["prenom"]));
            ?>
            <tr class="yborder">
                <td><?=$nu?></td>
                <td><?=date_time_fr($datas['date_reunion'])?></td>
                <td><?=$nom?></td>
                <td><?=html_entity_decode(stripslashes($datas["phone"]))?></td>

            </tr>
        <?php
        }

        ?>


        </tbody>
    </table>


</page>