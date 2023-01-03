// const imgPosition = document.querySelectorAll(".aspect-ratio-169 img")
// const imgContainer = document.querySelector('.aspect-ratio-169')
const dotItem = document.querySelectorAll(",dot")
// let index = 0
// let imgNuber = imgPosition.length
imgPosition.forEach(function(img,index){
  dotItem[index].addEventListener("click",function(){})
})
function slider (index){
  const dotActive =document.querySelectorAll('.active')
  dotActive.classList.remove("active")
  dotItem[index].classList.add("active")
}
// function imgSlide(){
//   index++
//   console.log(index)
//   if (index>=imgNuber){index=0}
//   imgContainer.style.left = "-" +  index*100 + "%"
  
// }

// setInterval(imgSlide,3000)

