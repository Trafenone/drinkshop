<?php

/** @var array $product */
/** @var array $cart */

$this->title = $product->name;

$isInCart = isset($cart[$product->id]);

$filePath = $product->image;
if ($filePath == null || !is_file($filePath)) {
    $filePath = '/project/wwwroot/uploads/no_image.jpg';
} else {
    $filePath = '/' . $filePath;
}

?>

<section class="bg-primary text-white text-center py-5">
    <div class="container">
        <h1>Деталі продукту</h1>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="<?= $filePath ?>" class="img-fluid" alt="Назва продукту">
            </div>
            <div class="col-md-6">
                <h2><?= $product->name ?></h2>
                <p class="text-muted">Категорія: <?= $product->category_name ?></p>
                <h4>Ціна: <?= $product->price ?></h4>
                <p>Опис продукту. <?= $product->description ?></p>
                <form id="add-to-cart-form">
                    <div id="panel" class="form-group mb-2 d-flex align-items-center <?= $isInCart ? 'd-none' : '' ?>">
                        <label for="quantity" class="me-2">Кількість:</label>
                        <input type="number" class="form-control w-25" id="quantity" name="quantity" value="1" min="1">
                    </div>
                    <input type="hidden" name="productId" value="<?= $product->id ?>">
                    <button type="submit" class="btn btn-primary <?= $isInCart ? 'disabled' : '' ?>">
                        <?= $isInCart ? 'У кошику' : 'Додати до кошика' ?>
                    </button>
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col">
                <h3>Детальний опис</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin imperdiet, velit id ultrices
                    convallis, elit lorem interdum dui, in vehicula nisi metus in arcu. Integer a sem at lacus tincidunt
                    fermentum. Vivamus scelerisque nunc vitae elit dictum, sit amet luctus nunc hendrerit.</p>
                <p>Maecenas at ligula nec magna auctor sollicitudin. Suspendisse potenti. Fusce vel sapien vehicula,
                    pretium libero in, feugiat est. Nulla facilisi. Vestibulum at tortor sit amet metus vestibulum
                    convallis a eu lacus. Curabitur ultricies odio ac magna tincidunt, eget volutpat metus vehicula.</p>
                <p>Quisque efficitur, augue at efficitur mollis, libero orci accumsan metus, in facilisis arcu nunc vel
                    eros. Sed interdum tortor ut nulla viverra, sed dictum ipsum gravida. Proin tincidunt lorem in enim
                    tempor, in interdum urna pellentesque. Cras nec sapien ut elit tincidunt vulputate.</p>
                <p>Sed ut purus at arcu dapibus convallis. Morbi vitae dui nec dolor commodo convallis. Integer vitae
                    magna odio. Aliquam erat volutpat. Duis faucibus lectus nec felis cursus, nec tempor ipsum placerat.
                    Ut a nunc vitae ex sollicitudin facilisis. Cras quis feugiat risus, sit amet finibus mi.</p>
            </div>
        </div>
    </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('add-to-cart-form').addEventListener('submit', function(event) {
            event.preventDefault();

            let formData = new FormData(this);
            let productId = formData.get('productId');
            let quantity = formData.get('quantity');

            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ productId, quantity })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const addButton = document.querySelector('#add-to-cart-form button[type="submit"]');
                        const panel = document.querySelector('#add-to-cart-form #panel');
                        panel.classList.add('d-none');
                        addButton.classList.add('disabled');
                        addButton.textContent = 'У кошику';
                    } else {
                        alert('Failed to add product to cart: ' + data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>
