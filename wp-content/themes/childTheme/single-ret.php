<style>
	h1{
		text-align: center;
	}
.bestilling .indhold{
	display:grid;
	grid-template-columns: 1fr 1fr;
	gap: 30px;
	justify-content: center;
	margin-right:10%;
	margin-left:10%;
	margin-bottom:5%;
}
img{
	width: 100%;
}
.knap{
	background-color: rgba(255, 255, 255, 0);
	border: solid 1px black;
	margin: 2%;
}
.knap:hover{
  background-color: rgba(255, 255, 255, 0);
	border:solid 2px black;
	color:black;
}
.tidOgSted{
    padding:2%;
}
.beskrivelse{
    padding:2%;
}
.billedeMedBeskrivelse {
   text-align: center;
   
}
.billedeMedBeskrivelse img{
    width: 50%;
}
.antal{
    display: grid;
    grid-row: 1fr 1fr;
}

@media (max-width: 700px){
	.indhold{
	display:grid;
	grid-template-columns: 1fr ;

}
}
      .formular{
        margin-left:30px;
        margin-right:30px;
      }
.pris{
  margin-top:-50px;
  padding-top:-50px;
  font-weight: bold;
}

</style>
<?php
/**
 * The template for displaying singleview
 */

get_header(); ?>

<?php if ( ( is_page() && ! inspiro_is_frontpage() ) && ! has_post_thumbnail( get_queried_object_id() ) ) : ?>

<div class="inner-wrap">
	<div id="primary" class="content-area">

<?php endif ?>

		<main id="main" class="site-main" role="main">
<button class="knap">TILBAGE</button>
<section class="projekt-oversigt">
<article>
	
	<h1></h1>
	<div class="indhold">
        <div class="billedeMedBeskrivelse">
	<img src="" alt="" class="picture" />
	
	<p class="beskrivelse"></p>
  <p class="pris"></p>
    </div>
    <br>
    <div class="tidOgSted">
    <h2>Tid & sted</h2>
  <p class="dato"></p>
  <p>SAMVÆR, Fælledvej 5, 2200 København</p>
  </div>
</div>

</article>
</section>
		</main><!-- #main -->

		
	<!-- booking af bord ved hjælp af formular plugin -->	
    <section class="formular">
      <h2>Book bord</h2>
	  <?php echo do_shortcode('[forminator_form id="579"]');?>
    </section>


<?php if ( ( is_page() && ! inspiro_is_frontpage() ) && ! has_post_thumbnail( get_queried_object_id() ) ) : ?>



	</div><!-- #primary -->
</div><!-- .inner-wrap -->

<?php endif ?>
<script>
   
	"use strict";
	let ret;
//data fra database indhentes
	document.addEventListener("DOMContentLoaded",getJson);
	async function getJson(){
		console.log("id er",<?php echo get_the_ID()?>);
		let jsonData=await fetch (`https://dahliarindom.dk/kea/eksamen2sem/wp-json/wp/v2/ret/<?php echo get_the_ID()?>`);
		ret=await jsonData.json();
    //funktionen visRet kaldes
		visRet();
	}
	function visRet(){
    //indhold fra databse indsættes i DOM
		document.querySelector("h1").textContent=ret.title.rendered;
    document.querySelector(".picture").src=ret.billede.guid;
		document.querySelector("p").textContent=ret.beskrivelse;
    document.querySelector(".dato").textContent=ret.dato+" "+ret.tidspunkt;
    document.querySelector(".pris").textContent=ret.pris+" kr";
    //tilbageknap får en eventlistener der hører efter "click" og kalder funktionen "tilbage"
    document.querySelector(".knap").addEventListener("click",tilbage);
	}
  //funktionen "tilbage" sørger for, at der ved klik loades den forrige url
	function tilbage(){
		history.back();
	}
</script>

<?php
get_footer();
