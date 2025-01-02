let store = [] ;

document.addEventListener("DOMContentLoaded", async function(){
    try {
        const response = await fetch('getData.php');
        const data = await response.json();
        store = data;
        }
        catch (error) {
        console.error('Error:', error);
    }
});//pour remplir le tableau dynamiquement avec le resultat de fetch


let panier = [];
const search = document.getElementById('search');
const items = document.querySelectorAll('.container > div');
const buttonsAjouter = document.querySelectorAll(".Ajouter");
const panierContainer = document.querySelector(".hidden");

const input = document.querySelectorAll('input[type="number"]');
const buttonShopping = document.querySelector("#panier");
const content = document.querySelector(".content");
const buttonCloseForPanier = document.querySelector(".hidden button");

const buttonCloseForDetails = document.querySelector(".hidden2 button");
const buttonsVoirDetails = document.querySelectorAll(".details");
const detailsContainer = document.querySelector(".hidden2");

const prev = document.querySelector(".prev");
const next = document.querySelector(".next");
const detailsList = document.createElement("div");
detailsList.setAttribute("class","list2");

search.addEventListener('input', function () {
    const result = this.value.toLowerCase();
    items.forEach(item => {
        const itemName = item.querySelector('span').innerText.toLowerCase();
        if (itemName.includes(result)) {
            item.style.display = 'flex';
        }
        else {
            item.style.display = 'none';
        }
    });
});

buttonShopping.addEventListener("click", (event) => {
    if (panierContainer.classList.contains("panier")) {
        panierContainer.classList.remove("panier");
        panierContainer.classList.add("hidden");

    } else {
        panierContainer.classList.remove("hidden");
        panierContainer.classList.add("panier");
        content.classList.add("blur");
    }
})

buttonCloseForPanier.addEventListener("click", (event) => {
    panierContainer.classList.add("hidden");
    content.classList.remove("blur");
    panierContainer.classList.remove("panier");
})

buttonCloseForDetails.addEventListener("click", (event) => {
    detailsContainer.classList.add("hidden2");
    content.classList.remove("blur");
    detailsContainer.classList.remove("slider");
    detailsList.innerHTML="";
})


buttonsAjouter.forEach((button, index) => {
    button.addEventListener('click', () => {
        ajouterInfo(index);
    });
});


buttonsVoirDetails.forEach((button,index) => {
    button.addEventListener('click',()=>{
        if (detailsContainer.classList.contains("slider")) {
            detailsContainer.classList.remove("slider");
            detailsContainer.classList.add("hidden2");
        } else {
            detailsContainer.classList.remove("hidden2");
            ajouterImages(index);
            detailsContainer.classList.add("slider");
            content.classList.add("blur");
        }
    })
});


function ajouterImages (index) { 


    let str = store[index].nom ; 
    let extracted = "" ;
    i=0; 
    while (str[i]!='-') {
        if (str[i]!=' '){
            extracted = extracted + str[i] ; 
        }
        i++;
    }
    
    let table = [] ;

    
    const div = document.createElement("div");
    div.setAttribute("class","item");

    
    table.push(`images/${extracted}.jpg`);
    table.push(`images/${extracted}1.jpg`);

    const principalImg = document.createElement("img");
    principalImg.setAttribute("src",table[0]);
    div.append(principalImg);
    detailsList.append(div);
    detailsContainer.append(detailsList);



    let j = 0 ; 
    const img = document.createElement("img");

    prev.addEventListener("click",(event)=>{
        detailsList.innerHTML="";
        div.innerHTML="";
        if (j > 0) {
            j -- ; 
        }
        else {
            j= table.length - 1 ; 
        }
        img.setAttribute("src",table[j]);
        div.append(img);
        detailsList.append(div);
        detailsContainer.append(detailsList);
    })

    next.addEventListener("click",(event)=>{
        detailsList.innerHTML="";
        div.innerHTML="";
        if (j === table.length - 1 ) {
            j = 0 ; 
        }
        else {
            j ++ ; 
        }
        img.setAttribute("src",table[j]);
        div.append(img);
        detailsList.append(div);
        detailsContainer.append(detailsList);
    }) 
}


const buttonConfirmer = document.createElement("button");
buttonConfirmer.textContent = "Confirmer Achat"
buttonConfirmer.setAttribute("class", "Confirmer");


buttonConfirmer.addEventListener("click", (event) => {
    confirm(`Merci pour votre achat!`);
    ul.innerHTML = "";
    panier = [];
    input.forEach((Input) => {
        Input.value = '';
    });
})

const ul = document.createElement("ul");
const liForPrice = document.createElement("li");
ul.setAttribute("class", "list");


function changingPrice () {
    let prixTotal = 0;
    panier.forEach((product) => {
        prixTotal = prixTotal + (product.prix * product.qte)
    });
    liForPrice.textContent = `Prix Total : ${prixTotal} DA`;
}



function ajouterInfo(index) {
    if (panier.length === 0) {
        ul.innerHTML = "";
    }
    const buttonSupprimer = document.createElement("button");
    buttonSupprimer.textContent = "×";

    buttonSupprimer.setAttribute("class", "supprimer");
    if (input[index].value != '') {
        const name = store[index].nom;
        const qte = parseInt(input[index].value);
        const prix = store[index].prix;
        let i = 0;
        while (i < panier.length && panier[i].name != name) {
            i++;
        }
        if (i === panier.length) {
            panier.push({ name, qte, prix });
            changingPrice();
            const li = document.createElement("li");
            li.textContent = `Produit: ${name},Prix: ${prix}DA,Quantité: ${qte}`;
            li.append(buttonSupprimer);
            ul.append(li);
            ul.append(liForPrice);
            ul.append(buttonConfirmer);
            console.log(ul);
            panierContainer.append(ul);
            console.log(panierContainer);
            alert("ajouté au panier");
        }
        else {
            alert("cet élément existe dans le panier")
        }
    }
    else {
        alert("choisir la quantité svp ");
    }

    
    buttonSupprimer.addEventListener("click", (event) => {
        panier = panier.filter(product => buttonSupprimer.parentElement.textContent.includes(product.name) != true);
            changingPrice();
            ul.append(liForPrice);
            ul.append(buttonConfirmer);
        buttonSupprimer.parentElement.remove();
        console.log(panier);
        if (panier.length === 0) {
            ul.innerHTML = "";
        }
    })
}

