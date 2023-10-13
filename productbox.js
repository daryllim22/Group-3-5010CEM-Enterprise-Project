const productBoxTemplate = document.createElement('pb-template');

productBoxTemplate.innerHTML = `
<style>
    .product-box {
        width: 250px;
        height: 320px;
        background-color: rgb(229, 229, 229);
        border:2px solid red;
        border-radius: 10px;
        margin: 15px;
        padding: 5px;
    }

    .product-box img {
        display: block;
        margin: auto;
        width: 100%;
        height: auto;
        border-radius: 10px;
    }

    .product-name {
        text-align: center;
        padding-top: 15px;
    }

    .product-price {
        text-align: center;
    }
</style>


<div class="product-box">
    <img src="${this.image}" alt="product image">
    <div class="product-name"><h3>${this.name}</h3></div>
    <div class="product-price">${this.price}</div>
</div>` //the html elements


class ProductBox extends HTMLElement {
    constructor() {
        super();
        this.image = 'images/wingman-plushie.jpeg';
        this.name = 'Product Name';
        this.price = 'Product Price';
    }

    connectedCallback() {
        const shadowRoot = this.attachShadow({mode: 'open'}); //shadow DOM created for custom elements, 'open' allowing for external CSS
        this.render(); //rendering the initial content
        shadowRoot.appendChild(productBoxTemplate.content);
    }


    render() {
        //regenerating the entire template with the new values
        productBoxTemplate.innerHTML = `
        <style>
            .product-box {
                width: 250px;
                height: 320px;
                background-color: rgb(229, 229, 229);
                border:2px solid red;
                border-radius: 10px;
                margin: 15px;
                padding: 5px;
            }

            .product-box img {
                display: block;
                margin: auto;
                width: 100%;
                height: auto;
                border-radius: 10px;
            }

            .product-name {
                text-align: center;
                padding-top: 15px;
            }

            .product-price {
                text-align: center;
            }
        </style>


        <div class="product-box">
            <img src="${this.image}" alt="product image">
            <div class="product-name"><h3>${this.name}</h3></div>
            <div class="product-price">${this.price}</div>
        </div>`
    }

    //update content method here
}

customElements.define('product-box', ProductBox);