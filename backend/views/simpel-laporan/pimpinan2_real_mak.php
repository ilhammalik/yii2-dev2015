<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use \common\components\MyHelper;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use \common\models\DaftarUnit;
use \common\components\HelperUnit;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = Yii::t('app', 'Laporan Realisasi Per Akun ');
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    th{
        text-align: center;
    }
</style>

<div class="simpel-personil-index">
    <div class="block">
        <div class="block-title">
            <ul class="nav nav-tabs ">
                <li >
                    <a href="<?= Url::to(['simpel-laporan/pimd']) ?>" >
                        Realisasi Unit Kerja</a>
                </li>
                <li class="active">
                    <a href="<?= Url::to(['simpel-laporan/pimdmak']) ?>" >
                        Realisasi Akun</a>
                </li>

            </ul>
        </div>
        <div class="wp-posts-index">

            <form class="FormAjax" method="get" action="">
                <div class="simpel-keg-search">

                    <div class="block">
                        <div class="block-title">
                            <h2>Pencarian</h2>
                        </div>
                        <div class="wp-posts-index">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-4">
                                        Satuan Kerja
                                    </div>
                                    <div class="col-md-8">
                                        <?= \common\components\HelperUnit::Unit(Yii::$app->user->identity->unit_id); ?><br/>
                                        <input type="hidden" name="unit" value="<?= Yii::$app->user->identity->unit_id; ?>">
                                    </div>
                                </div>
                                <hr/>
                                <div class="row"  >
                                    <div class="col-md-4">
                                        Unit Kerja 
                                    </div>
                                    <div class="col-md-8">
                                        <?php
                                        $data = ArrayHelper::map(\common\models\DaftarUnit::find()->where('unit_parent_id=' . Yii::$app->user->identity->unit_id.' and unit_id not in (131300)')->asArray()->all(), 'unit_id', 'nama');
                                        ?>
                                        <?php
                                        echo Select2::widget([
                                            'name' => 'unit_id',
                                            'data' => $data,
                                            'options' => [
                                                'id' => 'ids',
                                                'placeholder' => 'Pilih Unit Kerja ',
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true,
                                                'format' => 'yyyy-m-d'
                                            ],
                                        ]);
                                        ?>
                                    </div>
                                </div>
                             <hr/>
                                <div class="row">
                                    <div class="col-md-4">
                                        Bulan / Tahun
                                    </div>
                                    <div class="col-md-8">
                                        <table>
                                            <tr>
                                                <td>
                                                    <?php
                                                    echo DatePicker::widget([
                                                        'name' => 'tgl_mulai',
                                                        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                                        'pluginOptions' => [
                                                            'autoclose' => true,
                                                            'format' => 'yyyy-mm-dd'
                                                        ]
                                                    ]);
                                                    ?>

                                                </td>
                                                <td align="center" width="50">s/d</td>
                                                <td>
                                                    <?php
                                                    echo DatePicker::widget([
                                                        'name' => 'tgl_kembali',
                                                        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                                        'pluginOptions' => [
                                                            'autoclose' => true,
                                                            'format' => 'yyyy-mm-dd'
                                                        ]
                                                    ]);
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php echo Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?></div>
                    </div>
                </div>
            </form>
              <?php if(!empty($_GET)){ ?>
            <h4 align="center">LAPORAN REALISASI UNIT KERJA PER AKUN</h4>
            <h4 align="center" style="padding-top:-20px;"> <?= strtoupper(HelperUnit::unit($_GET['unit_id'])) ?> - <?= strtoupper(HelperUnit::unit($_GET['unit'])) ?></h4>
            <h4 align="center" style="padding-top:-20px;"><?= MyHelper::Formattgl($_GET['tgl_mulai']) ?> s/d  <?= MyHelper::Formattgl($_GET['tgl_kembali']) ?></h4>

            <p align="right">
            <a href="<?= Yii::$app->urlManagerr->createUrl(['simpel-laporan/pim-keg','unit'=>$_GET['unit'],'unit_id'=>$_GET['unit_id'],'tahun'=>date('Y'),'tgl_mulai'=>$_GET['tgl_mulai'],'tgl_kembali'=>$_GET['tgl_kembali']]) ?>" >
            <img src="<?= Url::to(['/images/printer.png']) ?>" width="60px"/>
            </a>
            </p>
            <div class=" table-responsive">
            <table class="table  table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2"> No. </th>
                        <th rowspan="2"> UNIT KERJA /  MAK </th>
                        <th rowspan="2"> PAGU </th>
                        <th colspan="13"> R E A L I S A S I</th>
                        <th rowspan="2"> S I S A </th>
                        <th rowspan="2" 0=""> % </th>
                    </tr>
                    <tr>
                        <?php for ($i = 1; $i <= 12; $i++) { ?>
                            <th><?= \common\components\MyHelper::BacaBulan($i) ?></th>
                        <?php } ?>
                        <th>Jumlah</th>
                    </tr>
                    <tr>
                        <?php for ($i = 1; $i <= 18; $i++) { ?>
                            <th><?= $i ?></th>
                        <?php } ?>
                    </tr>
                </thead>

                <?php
                $un = Yii::$app->user->identity->unit_id;
                $unit = \common\models\DaftarUnit::find()->where('unit_id in (' . $un . ')')->all();
                $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
                $no = 1;
                ?>
                <?php
                $un = Yii::$app->user->identity->unit_id;
                $unit = \common\models\DaftarUnit::find()->where('unit_id in (' . $un . ')')->all();
                $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
                ?>
                <?php
                $ese = $un;
                $satker = DaftarUnit::find()->where(' unit_id in (' . $ese . ')')->all();
                $n = 1;
                foreach ($satker as $sat) {
                    $ese = $sat->unit_id;
                    $hsl = Yii::$app->db->createCommand("SELECT 
                                      sum(alokasi_sub_mak) as total
                                     FROM v_pagu where  unit_id in(" . $ese . ")")->queryScalar();
                    ?>
                    <tr >
                        <td align="left"><?= $n ?>.</td>
                        <td><?= \common\components\HelperUnit::unit($sat->unit_id) ?></td>
                        <td align="center"><?php
                            $pag = HelperUnit::PaguUser($sat->unit_id);
                            $pagn = number_format(HelperUnit::PaguUser($sat->unit_id), 0, ",", ".");
                            echo $pagn;
                            ?>   
                        </td>
                        <?php
                        for ($i = 1; $i < 13; $i++) {

                            if ($i < 10) {
                                $a = '0' . $i;
                            } else {
                                $a = $i;
                            }
                            $unit = $sat->unit_id;
                            $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
                            $bln = $tahun . '-' . $a . '-';
                            $sql = "SELECT sum(b.jml) FROM simpel_keg as a 
                                        LEFT JOIN simpel_rincian_biaya as b on a.id_kegiatan=b.id_kegiatan
                                        LEFT JOIN pegawai.daf_unit as c on a.unit_id=c.unit_id
                                        where a.status in (2,3,4) and a.tgl_mulai like '%" . $bln . "%' and c.unit_parent_id='" . $unit . "'";
                            $nilaiReal = Yii::$app->db->createCommand($sql)->queryScalar();
                            ?>
                            <td><?php
                                if ($nilaiReal > 0) {
                                    echo number_format($nilaiReal, 0, ",", ".");
                                } else {
                                    echo '<center>-</center>';
                                }
                                ?></td>
                        <?php } ?>
                        <td> 
                            <?php
                            $re = HelperUnit::Real($sat->unit_id);
                            $ren = number_format(HelperUnit::Real($sat->unit_id), 0, ",", ".");
                            if ($ren > 0) {
                                echo $ren;
                            } else {
                                echo '<center>-</center>';
                            }
                            ?>  
                        </td>
                        <td align="center"><?php echo number_format($hsl - $re, 0, ",", "."); ?> </td>
                        <td align="center"><?php echo number_format(($re / $hsl) * 100, 2, ",", "."); ?> %</td>
                <?php
                    $n++;
                }
                    ?>
                </tr>

                <?php
                $ese = isset($_GET['unit_id']) ? $_GET['unit_id'] : $sat->unit_id;
                if (!empty($_GET['unit_id'])) {
                    $satk = DaftarUnit::find()->where(' unit_id in (' . $ese . ')')->all();
                } else {
                    $satk = DaftarUnit::find()->where(' unit_parent_id in (' . $un . ')')->all();
                }

                $n = 1;
                foreach ($satk as $sat) {

                    $ese = isset($_GET['unit_id']) ? $_GET['unit_id'] : $sat->unit_id;
                    if (!empty($ese)) {
                        $hsl = Yii::$app->db->createCommand("SELECT 
                                      sum(alokasi_sub_mak) as total
                                     FROM v_pagu where  unit_id in(" . $ese . ")")->queryScalar();
                    } else {
                        $hsl = Yii::$app->db->createCommand("SELECT 
                                    sum(alokasi_sub_mak) as total
                                FROM v_pagu where  unit_id=".$sat->unit_id)->queryScalar();
                    }
                    ?>

                    <tr>
                        <td align="right"><?= $n ?>.</td>
                        <td><?= \common\components\HelperUnit::unit($sat->unit_id) ?></td>
                        <td align="center"><?php
                            $pag = HelperUnit::PaguPim($sat->unit_id);
                            $pagn = number_format(HelperUnit::PaguPim($sat->unit_id), 0, ",", ".");
                            echo $pagn;
                            ?>   
                        </td>
                        <?php
                        for ($i = 1; $i < 13; $i++) {

                            if ($i < 10) {
                                $a = '0' . $i;
                            } else {
                                $a = $i;
                            }
                            $unit = isset($_GET['unit_id']) ? $_GET['unit_id'] : $sat->unit_id;
                            $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
                            $bln = $tahun . '-' . $a . '-';
                            $sql = "SELECT sum(b.jml) FROM simpel_keg as a 
                                        LEFT JOIN simpel_rincian_biaya as b on a.id_kegiatan=b.id_kegiatan
                                        LEFT JOIN pegawai.daf_unit as c on a.unit_id=c.unit_id
                                        where a.status in (2,3,4) and a.tgl_mulai like '%" . $bln . "%' and c.unit_id='" . $unit . "'";
                            $nilaiReal = Yii::$app->db->createCommand($sql)->queryScalar();
                            ?>
                            <td><?php
                                if ($nilaiReal > 0) {
                                    echo number_format($nilaiReal, 0, ",", ".");
                                } else {
                                    echo '<center>-</center>';
                                }
                                ?></td>

                        <?php } ?>

                        <td> 
                            <?php
                            $re = HelperUnit::RealEse($sat->unit_id);
                            $ren = number_format(HelperUnit::RealEse($sat->unit_id), 0, ",", ".");
                            if ($ren > 0) {
                                echo $ren;
                            } else {
                                echo '<center>0</center>';
                            }
                            ?>
                        </td>
                        <td align="center"><?php echo number_format($pag - $re, 0, ",", "."); ?> </td>
                        <td align="center"><?php
                            if (empty($pag)) {
                                echo "0";
                            } else {
                                echo number_format(($re / $pag) * 100, 2, ",", ".");
                            }
                            ?>
                            %</td>
                <?php
                    $n++;
                    echo '</tr>';
                ?>
                        <?php
                        $sql_ese = "SELECT mak, a.unit_id FROM simpel_keg as a 
                                        where a.status in (2,3,4) and a.unit_id='" . $sat->unit_id . "' group by a.detail_id";

                        $nilaiese = Yii::$app->db->createCommand($sql_ese)->queryAll();
                        $ese = 1;
                        foreach ($nilaiese as $sa) {

                            $ese = isset($_GET['unit_id']) ? $_GET['unit_id'] : $sat->unit_id;
                            $hsl = Yii::$app->db->createCommand("SELECT 
                                      sum(alokasi_sub_mak) as total
                                     FROM v_pagu where  unit_id in(" . $ese . ")")->queryScalar();
                            ?>

                        <tr>
                            <td><?php $ese ?></td>
                            <td>
                                <?php
                                if (!empty($sa['mak'])) {
                                    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $sa['mak'];
                                }
                                ?>

                            </td>
                            <?php
                            $sql_pagu = "SELECT sum(b.alokasi_sub_mak) FROM serasi2015_sql.news_nas_suboutput a LEFT JOIN serasi2015_sql.news_sub_mak_tahun b on a.suboutput_id=b.sub_mak_id LEFT JOIN pegawai.daf_unit c on a.unit_id3=c.unit_id WHERE a.tahun=" . $tahun . " and c.unit_id=" . $sa['unit_id'];
                            $nilaipagu = Yii::$app->db->createCommand($sql_pagu)->queryScalar();
                            ?>
                            <td><?= number_format($nilaipagu, 0, ",", ".") ?></td>
                            <?php
                            for ($i = 1; $i < 13; $i++) {

                                if ($i < 10) {
                                    $a = '0' . $i;
                                } else {
                                    $a = $i;
                                }
                                $unit = isset($_GET['unit_id']) ? $_GET['unit_id'] : $sat->unit_id;
                                $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
                                $bln = $tahun . '-' . $a . '-';
                                $sql = "SELECT sum(b.jml) FROM simpel_keg as a 
                                        LEFT JOIN simpel_rincian_biaya as b on a.id_kegiatan=b.id_kegiatan
                                        where a.status in (2,3,4) and a.mak='" . $sa['mak'] . "' and a.tgl_mulai like '%" . $bln . "%' and a.unit_id='" . $unit . "'";
                                $nilaiReal = Yii::$app->db->createCommand($sql)->queryScalar();
                                ?>
                                <td><?php
                                    if ($nilaiReal > 0) {
                                        echo number_format($nilaiReal, 0, ",", ".");
                                    } else {
                                        echo '<center>-</center>';
                                    }
                                    ?></td>

                            <?php } ?>
                            <td> 
                                <?php
                                $re = HelperUnit::RealEse($unit);
                                $ren = number_format(HelperUnit::RealEse($unit), 0, ",", ".");
                                if ($ren > 0) {
                                    echo $ren;
                                } else {
                                    echo '<center>-</center>';
                                }
                                ?>
                            </td>
                            <td align="center"><?php echo number_format($hsl - $nilaiReal, 0, ",", "."); ?> </td>
                            <td align="center"><?php
                                if (empty($pag)) {
                                    echo "0";
                                } else {

                                    echo number_format(($re / $pag) * 100, 2, ",", ".");
                                }
                                ?>
                                %</td>
                        </tr>
                        <?php
                        $ese++;
                    }
                    ?>

                <?php } ?>






            </table>
        </div>
           <?php } ?>

        </div>
    </div>
</div>
</body>
