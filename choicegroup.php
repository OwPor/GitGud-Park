<?php
    include_once 'links.php'; 
    include_once 'header.php'; 
    include_once 'nav.php'; 
    include_once 'modals.php'; 
?>
<style>
    main{
        padding: 20px 120px;
    }

</style>

<main>
    <button class="addpro mb-3">Created Choice Group</button>

    <table class="choice-table border rounded-2 bg-white">
        
        <tr class="choice-header">
            <th>Choice Group</th>
            <th><i class="fa-solid fa-circle ac"></i> Available Choices</th>
            <th><i class="fa-solid fa-circle uc"></i> Unavailable Choices</th>
        </tr>

        <tr class="choice-row">
            <td class="d-flex gap-2 align-items-center">
                <i class="fas fa-grip-vertical left"></i>
                <div>
                    <p class="mb-2">Choice of First Pizza</p>
                    <span class="cg">Required (Single), 6 Choices</span>
                </div>
            </td>
            <td>Pepperoni, Hawaiian, Vegetarian Special, Meat Special, Tomatoes</td>
            <td>Margarita</td>
        </tr>

        <tr class="choice-row">
            <td class="d-flex gap-2 align-items-center">
                <i class="fas fa-grip-vertical left"></i>
                <div>
                    <p class="mb-2">Choice of Drink</p>
                    <span class="cg">Optional (Multiple), 3 Choices</span>
                </div>
            </td>
            <td>Coca Cola, Bottled Water, Green Tee</td>
            <td></td>
        </tr>
    </table>
</main>
<?php
    include_once './footer.php'; 
?>