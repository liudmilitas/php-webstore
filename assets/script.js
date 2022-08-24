document.addEventListener("DOMContentLoaded", () => {
    const showButtons =  document.querySelectorAll(".show-product-details");

    for (const button of showButtons) {
        button.addEventListener("click", onClickProductDetails);
    }
});

async function onClickProductDetails(e){
    const id = this.dataset.id;

    const response = await fetch(`/shop/api/get-product.php?id=${id}`)
    const product = await response.json();

    const productDetailsContainer = document.getElementById("product-details");
    productDetailsContainer.hidden = false;

    document.getElementById("product-img").src = product.img_url;
    document.getElementById("product-title").innerText = product.title;
    document.getElementById("product-description").innerText = product.description;
    document.getElementById("product-price").innerText = product.price + " KR";
}