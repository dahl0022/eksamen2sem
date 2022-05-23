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
	background-color: white;
	border: solid 1.5px black;
	border-radius: 12px;
	margin-left: 2%;
}
.knap:hover{
	border:solid 1.5px #FA9628;
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
/* bestilling */
   .bestilling{
       padding:2%;
   }
    .overskrifter {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
      }
    .bestilling .indhold {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
      }
      .bestilling .pris {
        display: grid;
        grid-template-rows: 1fr 1fr;
      }
      .bestilling .pris p {
        margin-bottom: -20px;
      }

      .total {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
      }
      input {
        width: 80px;
        height: 30px;
      }

      /* .knap{
          border: none;
      }
      .knap:hover{
          border:none;
      } */
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
    </div>
    <br>
    <div class="tidOgSted">
    <h2>Tid & sted</h2>
  <p class="dato"></p>
  <p>SAMVÆR, Fælledvej 5, 2200 København</p>
  </div>
</div>
<section class="bestilling">
      <div class="overskrifter">
        <h3>Billetter</h3>
        <h4>Pris</h4>
        <h4>Antal</h4>
      </div>
      <hr />
      <div class="indhold">
        <p>Billetter</p>
        <div class="pris">
          <p id="pris"></p>
        </div>

       <div class="antal">
          <input type="text" placeholder="name" id="uname" />
      <input type="button"value="Find pris" onclick="send()" />
      </div>
      </div>
      <hr />
      <div class="total">
        <h2>Total</h2>
        <p id="totalPris"></p>
      </div>
      <div class="betal">
        <button>Betal</button>
      </div>
    </section>
</article>
</section>

		</main><!-- #main -->

<?php if ( ( is_page() && ! inspiro_is_frontpage() ) && ! has_post_thumbnail( get_queried_object_id() ) ) : ?>


	</div><!-- #primary -->
</div><!-- .inner-wrap -->

<?php endif ?>
<script>
	"use strict";
//udskriv værdi fra input felt i konsollen
  let uname = document.querySelector("#uname");
      function send() {
        console.log(uname.value);
      }
    
// let veardi=uname.value;
// let prisPaaVare=ret.pris;

	let billede = document.querySelector
	let ret;
	document.addEventListener("DOMContentLoaded",getJson);
	async function getJson(){
		console.log("id er",<?php echo get_the_ID()?>);
		let jsonData=await fetch (`https://dahliarindom.dk/kea/eksamen2sem/wp-json/wp/v2/ret/<?php echo get_the_ID()?>`);
		ret=await jsonData.json();
		visRet();
	}
	function visRet(){
         let kroner=ret.pris;
      console.log(uname.value*kroner)
		console.log("visRet",ret);
		
		document.querySelector("h1").textContent=ret.title.rendered;
                    document.querySelector(".picture").src=ret.billede.guid;
		
		document.querySelector("p").textContent=ret.beskrivelse;

		document.querySelector(".knap").addEventListener("click",tilbage);
        document.querySelector(".dato").textContent=ret.tidspunkt;
        document.querySelector("#pris").textContent=ret.pris+" kr";
        document.querySelector("#totalPris").textContent=uname.value*kroner+".00 kr";

        // document.querySelector("#total").textContent=veardi*prisPaaVare;
        
	}
	function tilbage(){
		history.back();
	}


</script>
<?php
get_footer();
