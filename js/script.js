

//add new product

        // Get modal elements
        const addProductBtn = document.getElementById('addProductBtn');
        const modal = document.getElementById('addProductModal');
        const modalOverlay = document.getElementById('modalOverlay');
        const discardBtn = document.getElementById('discardBtn');
        const addProductForm = document.getElementById('addProductForm');
        const imageUpload = document.getElementById('imageUpload');

        // Show modal
        function showModal() {
            modal.style.display = 'block';
            modalOverlay.style.display = 'block';
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        // Hide modal
        function hideModal() {
            modal.style.display = 'none';
            modalOverlay.style.display = 'none';
            document.body.style.overflow = ''; // Restore scrolling
            addProductForm.reset();
        }

        // Add event listeners
        addProductBtn.addEventListener('click', showModal);
        discardBtn.addEventListener('click', hideModal);
        modalOverlay.addEventListener('click', hideModal);

        // Handle form submission
        addProductForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(addProductForm);
            const productData = Object.fromEntries(formData.entries());
            
            // Here you would typically send this data to your backend
            console.log('Product data:', productData);
            
            // Add new row to table (for demonstration)
            const table = document.querySelector('table tbody');
            const newRow = table.insertRow();
            newRow.innerHTML = `
                <td>${productData.productName}</td>
                <td>£${productData.buyingPrice}</td>
                <td>${productData.quantity} ${productData.unit}</td>
                <td>${productData.thresholdValue} ${productData.unit}</td>
                <td>${productData.expiryDate}</td>
                <td><span class="status in-stock">In-stock</span></td>
            `;
            
            hideModal();
        });

        // Handle image upload
        imageUpload.addEventListener('click', () => {
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.onchange = (e) => {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (event) => {
                        imageUpload.innerHTML = `
                            <img src="${event.target.result}" alt="Product image" style="max-width: 100%; max-height: 150px;">
                        `;
                    };
                    reader.readAsDataURL(file);
                }
            };
            input.click();
        });

        // Handle drag and drop
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            imageUpload.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        imageUpload.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const file = dt.files[0];

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    imageUpload.innerHTML = `
                        <img src="${event.target.result}" alt="Product image" style="max-width: 100%; max-height: 150px;">
                    `;
                };
                reader.readAsDataURL(file);
            }
        }
