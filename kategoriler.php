﻿<?php 

include 'header.php'; 

if(isset($_GET['sef']))
{

	$kategorisor=$db->prepare("SELECT * FROM kategori WHERE kategori_seourl=:seourl");
	$kategorisor->execute(array(
		'seourl' => $_GET['sef']
		));

	$kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC);
	$kategori_id=$kategoricek['kategori_id'];
	$urunsor=$db->prepare("SELECT * FROM urunler WHERE kategori_id=:kategori_id ORDER BY urun_id DESC");
	$urunsor->execute(array(
		'kategori_id'=>$kategori_id
		));
	$say=$urunsor->rowCount();
}

else
{
	$urunsor=$db->prepare("SELECT * FROM urunler ORDER BY urun_id DESC");
	$urunsor->execute();
}

?>


<div class="container">
	<div class="row">
		<div class="col-md-9"><!--Main content-->
			<div class="title-bg">
				<div class="title">Ürünler</div>
			</div>
			<div class="row prdct"><!--Products-->

				<?php 

				while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) {?>
				<div class="col-md-4">
					<div class="productwrap">
						<div class="pr-img">
							<div class="new"></div>
							<!--
							<a href="urunler-<?=seo($uruncek["urun_ad"]) ?>"><img src="images\sample-3.jpg" alt="" class="img-responsive"></a>
						-->
						<a href="urunler-<?=seo($uruncek["urun_ad"]).'-'.$uruncek["urun_id"] ?>"><img src="<?php echo $uruncek['urun_foto'] ?>" width="200" height="200" alt="" class=""></a>

						<div class="pricetag on-sale">
							<div class="inner on-sale">
								<span class="onsale">
									<span class="oldprice"><?php echo $uruncek['urun_fiyat']*1.5 ?>₺</span>
									<?php echo $uruncek['urun_fiyat']*1 ?>₺</span>
								</div>
							</div>
						</div>
						<span class="smalltitle"><a href="product.htm"><?php echo $uruncek['urun_ad'] ?></a></span>
						<span class="smalldesc">Item no.: <?php echo $uruncek['urun_id'] ?></span>
					</div>
				</div>
				<?php } ?>
			</div>
					<!--Products
				<ul class="pagination shop-pag">
					<li><a href="#"><i class="fa fa-caret-left"></i></a></li>
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#"><i class="fa fa-caret-right"></i></a></li>
				</ul>		pagination-->

			</div>
			<?php include 'sidebar.php'; ?>
		</div>
		<div class="spacer"></div>
	</div>
	<?php include'footer.php'; ?>