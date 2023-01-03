const bigImg = document.querySelector(".product-content-left-big-img img")
const smalImg = document.querySelectorAll(".product-content-left-small-img img")
smalImg.forEach(function(imgItem,X){
    imgItem.addEventListener("click",function() {
        bigImg.src = imgItem.src
    })
})




// ////////////////////////////////////////////////
const gioithieu = document.querySelector(".gioithieu")
const baoquan = document.querySelector(".baoquan")

if (gioithieu) {
    gioithieu.addEventListener("click",function(){
        document.querySelector(".product-content-right-bottom-content-baoquan").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-gioithieu").style.display = "block"
    })
}

if (baoquan) {
    baoquan.addEventListener("click",function(){
        document.querySelector(".product-content-right-bottom-content-baoquan").style.display = "block"
        document.querySelector(".product-content-right-bottom-content-gioithieu").style.display = "none"
    })
}

const butTon = document.querySelector(".product-content-right-bottom-top")
if (butTon) {
    butTon.addEventListener("click",function(){
        document.querySelector(".product-content-right-bottom-content-big").classList.toggle("activeQ")
    })
}