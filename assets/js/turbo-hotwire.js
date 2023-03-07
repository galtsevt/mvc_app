import * as Turbo from "@hotwired/turbo"

Turbo.start();
Turbo.setProgressBarDelay(5);

document.addEventListener("DOMContentLoaded", () => {
    let loader = document.getElementById('loader')
    if(loader) {
        setTimeout(() => {
            loader.classList.add('d-none')
        }, 2000)
    }
})

