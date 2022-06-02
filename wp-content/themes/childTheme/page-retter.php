<style>
html {
  scroll-behavior: smooth;
}
.knap:hover{
  background-color: rgba(255, 255, 255, 0);
	border:solid 2px black;
	color:black;
}
#ret-oversigt{
    display:flex;
    flex-wrap: wrap;
	gap: 30px;
   justify-content: center;
}
#cocktail-oversigt{
    display:flex;
    flex-wrap: wrap;
	gap: 30px;
   justify-content: center;
}
#ret-oversigt article{
    width: 250px;
    cursor: pointer;
}
main h2{
    text-align:center;
}
main h1{
    text-align:center;
}
main h5{
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
/* dropdown inspiration fra W3 schools - https://www.w3schools.com/howto/howto_css_dropdown.asp*/
.dropbtn {
     width: 160px;
    background-color: rgba(255, 255, 255, 0);
    border: solid 1px black;
  padding: 16px;
  font-size: 16px;
  cursor: pointer;
}
.dropbtn:hover{
  background-color: rgba(255, 255, 255, 0);
	border:solid 2px black;
	color:black;
   
}
button .height{
	height:50px;

}
.dropdown {
  position: relative;
  display: inline-block;
  margin-bottom: 50px;
  margin-right:8px;

  /* color: black;
  border:solid black 1px; */
}
.filter{
width: 250px;	
height: 50px;
}
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #fafaf7;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;

max-height: 400px;
overflow-x: hidden;
overflow-y: auto;
}

.dropdown-content a {
  text-decoration: none;
  display: block;
    width: 250px;
	overflow: hidden;
}

.dropdown-content a:hover {
    background-color: #fafaf7;
}

.dropdown:hover .dropdown-content {
  display: block;

}
.dropdown-content button{
    background-color: #fafaf7;
    /* border:solid black 1px; */
    cursor: pointer;
}
.dropdown-content button:hover{
    background-color: #fafaf7;
    border:solid black 2px;
    color:black;
}

/*styling af cocktail oversigt*/
     .container {
        position: relative;
        max-width: 250px;
        margin: 0 auto;
      }

      .container img {
        vertical-align: middle;
      }

      .container .content {
        position: absolute;
        bottom: 35%;
        background: #8B6D66;
        background: #8b6d666f;
        color: #f1f1f1;
        width: 100%;
        padding: 20px;
      }
      .container .content h2{
          color:white;
      }
      #cocktail-oversigt{
          margin-bottom: 20px;
      }
/*mellem i ret oversigten gøres mindre*/
#ret-oversigt h2{
margin-top:-40px;
padding-top:-40px;
}
.beskrivelse{
margin-top:-20px;
padding-top:-20px;
}
.showSingle{
min-width: 500px;
}
 .knap{
	background-color: rgba(255, 255, 255, 0);
	border: solid 1px black;
    height: 62px;
    width: 160px;
    text-align: center;
}
.knapper{
    display: flex;
   flex-wrap: wrap;
   justify-content: left;
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
				<H1 class="overskrift entry-title">MENU</H1>

			</section>
<p>Samvær Spisebar har 60 pladser og kører efter først til mølle princippet - så skynd dig at book bord.
Er du studerende tilbyder vi 34 % rabat!
Er du vegetar eller har nogen allergier så skriv det i kommentaren.</p>
<section>
<div class="knapper">
<div class="dropdown">
  <button class="dropbtn">- Dato -</button>
  <div class="dropdown-content">
<nav id="filtrering"><button data-ret="alle">Alle</button></nav>
  </div>
</div>
<button onclick="window.location.href='#cocktail-oversigt';" class="knap">Cocktails</button>
</div>
            <hr>		
			<section id="ret-oversigt"></section>
            <hr>
           <h2>Cocktails</h2>
            <section id="cocktail-oversigt"></section>
		</main>

		
<template id="mytemplate">
			<article id="template_article">
                   <div class="billede">
                    <img src="" alt="" class="picture" />
                </div>
                <h5 class="dag tid"></h5>
                <h2 class="overskrift"></h2>
				<p class="beskrivelse"></p>
			</article>
</template>

<template id="cocktailtemplate">
			<article class="container">
                
                <div class="billede">
                <img class="cocktailBillede" src="" alt="" style="width: 100%">
                </div>
                <div class="content">
                 <h2 class="cocktailNavn"></h2>
                 </div>
			</article>
</template>
<?php if ( ( is_page() && ! inspiro_is_frontpage() ) && ! has_post_thumbnail( get_queried_object_id() ) ) : ?>

	</div><!-- #primary -->
</div><!-- .inner-wrap -->

<?php endif ?>

<script>
// variabler og konstanter for retterne oprettes

	let retter;
    let categories;
	let filterRet = "alle";
    const liste = document.querySelector("#ret-oversigt");
	const skabelon = document.querySelector("#mytemplate");

// variabeler og konstanter for cocktails oprettes
    let cocktails=[];
    const cocktailListe=document.querySelector("#cocktail-oversigt");
    const cocktailSkabelon=document.querySelector("#cocktailtemplate");

// konstanter med url'er til json data oprettes
	const url = "https://dahliarindom.dk/kea/eksamen2sem/wp-json/wp/v2/ret?per_page=100";
    const caturl="https://dahliarindom.dk/kea/eksamen2sem/wp-json/wp/v2/categories?per_page=100";
    const cocktailurl = "https://dahliarindom.dk/kea/eksamen2sem/wp-json/wp/v2/cocktail?per_page=100";
// når dommens indhold er doaded begynder funktionen "start"
	document.addEventListener("DOMContentLoaded", start);

	function start() {
//funktionen "getJson" kaldes
	getJson();
		
	}
	async function getJson () {
// indhold fra rest API hentes
		let response = await fetch(url);
        let catresponse = await fetch(caturl);
        let cocktailresponse=await fetch(cocktailurl);
        cocktails=await cocktailresponse.json();
		retter = await response.json();
        categories=await catresponse.json();
        let filterRet;
//funktioner kaldes
        visCocktails();
		visRetter();
		opretKnapper();
	}
    
     function opretKnapper () {
//filtrerings knapper oprettes ved hjælp af kategorierne
            categories.forEach(cat => {
                document.querySelector("#filtrering").innerHTML += `<button class="filter" data-ret=${cat.id}">${cat.name}</button>`
            })
// funktionen addEventListenersToButtons kaldes
            addEventListenersToButtons();
     }
	function addEventListenersToButtons() {
// der oprættes event listener på klik på alle filtreringsknapperne og funktionen "filtrering" kaldes
            document.querySelectorAll("#filtrering button").forEach(elm => {
                elm.addEventListener("click", filtrering);
            })
    };	

	function filtrering() {
            filterRet = this.dataset.ret; 
            visRetter();
     }
// visCocktails kaldes direkte uden om filtrering, da disse ikke skal indgå i filtrering, men blot indhentes fra rest API
function visCocktails(){
    cocktails.forEach(cocktail=>{
// kontanten klon oprettes for at forkorte den følgende kode
        const klon=cocktailSkabelon.cloneNode(true).content;
// indhold indhentes 
        klon.querySelector(".cocktailNavn").textContent=cocktail.title.rendered;
        klon.querySelector(".cocktailBillede").src=cocktail.billede.guid;
// indhold indsættes i #cocktail-oversigt som kommer fra den tidligere bestemte konstant
        cocktailListe.appendChild(klon);
    })
}

    function visRetter() {
console.log(retter);
// variablen temp oprettes som henviser til template tagget
  let temp=document.querySelector("template");
// variblen container oprettes som henviser til ret-oversigt
  let container=document.querySelector("#ret-oversigt");
// containerens udgangspunkt sættes til ikke at have noget indhold
  container.innerHTML="";
// retter indsættes nu i dommen
  retter.forEach(ret=>{ 
    if( filterRet=="alle" || ret.categories.includes(parseInt(filterRet))){
         let klon=temp.cloneNode(true).content;
// ved valg af dato (filtrering) tilføjes en ny klasse til template_article, så den får en anden styling
        if(filterRet!="alle"){
            klon.querySelector("#template_article").classList.add("showSingle");
        }
// indhold indhentes 
        klon.querySelector("h2").textContent = ret.title.rendered;
         klon.querySelector("h5").textContent=ret.dato;
        klon.querySelector("img").src = ret.billede.guid;
        klon.querySelector("p").textContent = ret.beskrivelse;
// singleview bliver muligt
klon.querySelector("article").addEventListener("click",()=>{location.href=ret.link;})
// indhold indsættes i #ret-oversigt som kommer fra den tidligere bestemte konstant
        container.appendChild(klon);
      }
  })
}




</script>
<?php
get_footer();
