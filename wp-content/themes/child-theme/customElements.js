class CopyrightYear extends HTMLElement{
    connectedCallback(){
        this.innerHTML = new Date().getFullYear();
    }
}

customElements.define("x-year", CopyrightYear);

class TwoSidedMarket extends HTMLElement{
    connectedCallback(){
        this.innerHTML = `<a href="menu" class="btn">Browse our menu</a>&nbsp;<a href="reservation" class="btn">Reserve a table </a>`;
    }
}

customElements.define("x-twosides", TwoSidedMarket);