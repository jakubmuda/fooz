(function () {

    document.addEventListener('DOMContentLoaded', function () {
        const box = document.getElementById('fooz-related-books');

        if (!box) {
            return;
        }

        fetch(foozAjax.ajaxUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                nonce: foozAjax.nonce,
                action: foozAjax.action,
                post_id: box.dataset.postId,
            })
        })
        .then(function(response){
            return response.json();
        })
        .then(function(response){
            if(response.success){

                box.innerHTML = `
                    <ul>
                        ${response.data.map(book => `
                            <li>
                                <div><a href="${book.url}">${book.title}</a></div>
                                <div><small>${book.date}</small></div>
                                <div><em>${book.genres.join(', ')}</em></div>
                                <p>${book.excerpt}</p>
                            </li>
                        `).join('')}
                    </ul>
                `;
                
            } else {
                console.error('Error');
            }
        })
        .catch(function(error){
            console.error(error);
        });

    });

})();

