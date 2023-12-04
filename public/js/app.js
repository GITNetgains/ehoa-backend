// Attach a "change" event listener to all elements with the specified class

function attachChangeListener(element) {
    element.addEventListener('change', function (event) {
        var categoryData = @json($categories);
        // Your code to handle the change event goes here
        let category_id = event.target.value;
        //console.log(category_id);
        console.log(event.target.value);
        while (document.getElementById('categories-list').querySelector('select:last-child').id != event.target.id) {
            let categoriesList = document.getElementById('categories-list');
            let lastChild = categoriesList.querySelector('select:last-child');
            console.log(lastChild.id);
            categoriesList.removeChild(lastChild);
        }

        if (categoryData.hasOwnProperty(category_id)) {
            let categoriesList = document.getElementById('categories-list')
            let newCategory = document.createElement('select');
            newCategory.className = 'form-control category-item mt-2';
            newCategory.id = category_id;
            let category = categoryData[category_id];
            let initialOption = document.createElement('option');
            initialOption.value = "-1";
            initialOption.text = "None";
            newCategory.appendChild(initialOption);
            for (let key in category) {
                if (category.hasOwnProperty(key)) {
                    let option = document.createElement('option');
                    option.value = category[key].category_id;
                    option.text = category[key].category_name;
                    newCategory.appendChild(option);
                }
            }
            categoriesList.appendChild(newCategory);
            attachChangeListener(newCategory);
        } else {
            event.target.name = 'parent_type';
            console.log("success");
        }
    });
}

document.querySelectorAll('.category-item').forEach(function (element) {
    attachChangeListener(element);
});
