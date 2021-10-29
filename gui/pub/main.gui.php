<?php

function content($data=null)
{
    ?>
<header>
    <h1><?=$data['title']?>
    </h1>
</header>
<section>
    <aside>
        <?=sidebar($data['products'])?>
    </aside>
    <main id="content">
    </main>
</section><?php
}

function sidebar($products)
{
    ?>
<fieldset>
    <legend>Фильтры</legend>
    <p>Количество просмотров</p>
    <label> от:
        <input type="number" id="views_min" max="999999" />
    </label>
    <label> до:
        <input type="number" id="views_max" max="999999" />
    </label>
    <p>Продукт</p>
    <label>
        <select id="product">
            <option value=""> ( все ) </option>
            <?php foreach ($products as $product) :?>
            <option
                value="<?=$product['name']?>">
                <?=$product['name']?>
            </option>
            <?php endforeach; ?>
        </select>
    </label>
    <p>Дата добавления</p>
    <table>
        <tr>
            <td><label for="date_start">от:</label></td>
            <td><input type="date" id="date_start" /></td>
        </tr>
        <tr>
            <td><label for="date_end">до:</label></td>
            <td><input type="date" id="date_end" /></td>
        </tr>
    </table>
    <p>
        <label>
            Статей на странице:
            <select id="count">
                <option value="1">1</option>
                <option value="3">3</option>
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="20">20</option>
            </select>
        </label>
    </p>
    <p class="button"><button id="filter">Применить</button></P>
</fieldset>
<?php
}
