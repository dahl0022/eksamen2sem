<style>
#ret-oversigt{
	/* display: grid; */
	/* grid-template-columns: repeat(auto-fill,minmax(250px,1fr));
	gap: 30px; */
   
}
h2{
    text-align:center;
}
h1{
    text-align:center;
}

#section_two .indhold{
   display: grid;
	grid-template-columns: repeat(auto-fill,minmax(200px,1fr));
	gap: 30px; 
    margin-bottom:20px;
}
#section_two h3{
    color:white;
    text-align:center;
    padding-top:90px;
}
.cocktail1{
    height:250px;
    aspect-ration:1/1;
    background-image:url(http://dahliarindom.dk/kea/eksamen2sem/wp-content/uploads/2022/05/COLOURBOX47482822-scaled.jpg);
    background-size:cover;
    background-repeat: no-repeat;
}
.cocktail2{
    height:250px;
    aspect-ration:1/1;
    background-image:url(http://dahliarindom.dk/kea/eksamen2sem/wp-content/uploads/2022/05/COLOURBOX47482822-scaled.jpg);
    background-size:cover;
    background-repeat: no-repeat;
}
.cocktail3{
    height:250px;
    aspect-ration:1/1;
    background-image:url(http://dahliarindom.dk/kea/eksamen2sem/wp-content/uploads/2022/05/COLOURBOX47482822-scaled.jpg);
    background-size:cover;
    background-repeat: no-repeat;
}
.cocktail4{
    height:250px;
    aspect-ration:1/1;
    background-image:url(http://dahliarindom.dk/kea/eksamen2sem/wp-content/uploads/2022/05/COLOURBOX47482822-scaled.jpg);
    background-size:cover;
    background-repeat: no-repeat;
}

.dropbtn {
  background-color: lightgrey;
  color: black;
  border:solid 1px rgb(169, 169, 169);
  border-radius: 5px;
  padding: 16px;
  font-size: 16px;
  cursor: pointer;

}

button .height{
	height:50px;

}
.dropdown {
  position: relative;
  display: inline-block;
  margin-bottom: 50px;
  margin-right:8px;
}
.filter{
width: 250px;	
height: 50px;
}

/* dropdown */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;

max-height: 400px;
overflow-x: hidden;
overflow-y: auto;
}

.dropdown-content a {
  color: black;
  text-decoration: none;
  display: block;
    width: 250px;
	overflow: hidden;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>
<?php
/**
 * The template for displaying all pages projekter
 */

get_header(); ?>

<?php if ( ( is_page() && ! inspiro_is_frontpage() ) && ! has_post_thumbnail( get_queried_object_id() ) ) : ?>

<div class="inner-wrap">
	<div id="primary" class="content-area">

<?php endif ?>
		<main id="main" class="site-main" role="main">
			<section id="section_one">
				<br>
				<H1>MENU</H1>
	
			</section>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus deleniti repudiandae voluptatibus natus excepturi sed ex illum cum nulla perspiciatis dicta, vero cupiditate, rerum commodi numquam libero fuga hic blanditiis odit iure obcaecati quis consequuntur optio soluta.</p>
<div class="knapper">



<div class="dropdown">
  <button class="dropbtn">- Dato -</button>
  <div class="dropdown-content">
<nav id="filtrering"><button data-ret="alle">Alle</nav>
  </div>
</div>
</div>
			

			<section id="ret-oversigt"></section>

		</main>

		
<template id="mytemplate">
			<article>
                <h2 class="dag"></h2>
                <h2 class="overskrift"></h2>
                <div class="billede">
                    <img src="" alt="" class="picture" />
                </div>
				
				<p class="beskrivelse"></p>
			</article>
</template>
<hr>
<section id="section_two">
    <h2>Cocktails</h2>
    <div class="indhold">
    <div class="cocktail1">
<h3>Samvær Spritz</h3>
    </div>
     <div class="cocktail2">
        <h3>Samvær G&T</h3>
    </div>
     <div class="cocktail3">
       <h3>Pink Senorita</h3> 
    </div>
     <div class="cocktail4">
       <h3>Negroni Spritz </h3>
    </div>
    </div>
</section>
<?php if ( ( is_page() && ! inspiro_is_frontpage() ) && ! has_post_thumbnail( get_queried_object_id() ) ) : ?>

	</div><!-- #primary -->
</div><!-- .inner-wrap -->

<?php endif ?>

<script>


	let retter;
    let categories;
	let filter = "alle";
	let filterRet = "alle";
	const liste = document.querySelector("#ret-oversigt");
	const skabelon = document.querySelector("#mytemplate");
	console.log(skabelon);


	const url = "https://dahliarindom.dk/kea/eksamen2sem/wp-json/wp/v2/ret?per-page=100";
	// const klasseurl = "http://dahliarindom.dk/kea/09_cms/unesco/wp-json/wp/v2/klassetrin";
    const caturl="https://dahliarindom.dk/kea/eksamen2sem/wp-json/wp/v2/categories";

	document.addEventListener("DOMContentLoaded", start);

	function start() {
		console.log("start");
		    getJson();
		
	}

	

	async function getJson () {
		let response = await fetch(url);
        let catresponse = await fetch(caturl);
		// let klassetrinresponse = await fetch(klasseurl);

		retter = await response.json();
        categories=await catresponse.json();
        let filterRet;
		// klassetrin = await klassetrinresponse.json();
		// console.log("klassetrin");
		console.log(categories);
		visRetter();
		opretKnapper();
	}
    
     function opretKnapper () {
            categories.forEach(cat => {
                document.querySelector("#filtrering").innerHTML += `<button class="filter" data-ret=${cat.id}">${cat.name}</button>`
            })
            addEventListenersToButtons();

     }

	function addEventListenersToButtons() {
            document.querySelectorAll("#filtrering button").forEach(elm => {
                elm.addEventListener("click", filtrering);
            })
    };	

	function filtrering() {
			console.log("filtrerRetter");
            filterRet = this.dataset.ret; 
            console.log(filterRet);
            visRetter();
     }

    function visRetter() {
			console.log("visRetter");
  let temp=document.querySelector("template");
  let container=document.querySelector("#ret-oversigt");
  container.innerHTML="";
  retter.forEach(ret=>{
      if( filterRet=="alle" || ret.categories.includes(parseInt(filterRet))){
      let klon=temp.cloneNode(true).content;
        klon.querySelector("h2").textContent = ret.title.rendered;
        klon.querySelector("img").src = ret.billede.guid;
        klon.querySelector("p").textContent = ret.beskrivelse;
klon.querySelector("article").addEventListener("click",()=>{location.href=ret.link;})
        container.appendChild(klon);
      }
  })
}




</script>
<?php
get_footer();
