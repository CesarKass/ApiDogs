(function(){

    axios.get('/api/articulos')
        .then(function (response) {
            // handle success
        let template = ``;
        for (const iterator of response.data) {
            template += `
                <div class="column" >
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title">
                                ${iterator.title}
                            </p>
                        </header>
                        <div class="card-content">
                            <div class="content">
                
                                <a href="#"><strong>id</strong>: ${iterator.id}</a></a>
                                <br>
                                <p><strong>Descripción</strong>: ${iterator.description}</p>
                            </div>
                        </div>
                        <footer class="card-footer">
                            <a href="#" class="card-footer-item">Editar</a>
                            <a href="#" class="card-footer-item">Eliminar</a>
                        </footer>
                    </div>
                </div>
            `;
        }            
            
        document.querySelector('#container-cards').innerHTML = template;
        })
        .catch(function (error) {
            // handle error
            document.querySelector('#empty-msg').innerHTML = "No existen registros";
            console.log(error);
        });
    
})();