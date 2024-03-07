function AutoComplete(id, list) {
    let searchWrapper = null;
    if (searchWrapper == null) {
        searchWrapper = document.getElementById(`${id}`);
        //const icon = searchWrapper.querySelector(".icon");
        //let linkTag = searchWrapper.querySelector("a");
        //let webLink;
        if (searchWrapper != null) {
            const inputBox = searchWrapper.children[0];
            let divList = document.createElement('div')
            divList.classList.add('list')
            let icon = document.createElement('i')
            icon.classList.add('icon-cherche')
            icon.classList.add('bi')
            icon.classList.add('bi-search')
            searchWrapper.appendChild(divList)
            searchWrapper.appendChild(icon)
            icon.addEventListener('click', e=>{
                alert('Ola clicou no shearche')
            })

            function showSuggestions(list) {
                let listData;
                if (!list.length) {
                    let userValue = inputBox.value;
                    listData = `<li>${userValue}</li>`;
                } else {
                    listData = list.join('');
                }
                divList.innerHTML = listData;
            }

            inputBox.onkeyup = (e) => {
                let userData = e.target.value; //user enetered data
                let emptyArray = [];

                if (e.key === 'Enter') {
                    if (userData) {
                        window.open(`https://www.google.com/search?q=${userData}`, '_blank')
                    }
                }

                if (userData) {
                    /*icon.onclick = ()=>{
                        webLink = `https://www.google.com/search?q=${userData}`;
                        linkTag.setAttribute("href", webLink);
                        linkTag.click();
                    }*/
                    emptyArray = list.filter((data) => {
                        //filtering array value and user characters to lowercase and return only those words which are start with user enetered chars
                        return data.toLocaleLowerCase().startsWith(userData.toLocaleLowerCase());
                    });
                    emptyArray = emptyArray.map((data) => {
                        // passing return data inside li tag
                        return data = `<li>${data}</li>`;
                    });
                    searchWrapper.classList.add("active"); //show autocomplete box
                    showSuggestions(emptyArray);
                    let allList = divList.children;
                    for (let i = 0; i < allList.length; i++) {
                        //adding onclick attribute in all li tag
                        allList[i].addEventListener("click", (es) => {
                            inputBox.value = es.target.textContent;
                            /*icon.onclick = ()=>{
                                webLink = `https://www.google.com/search?q=${selectData}`;
                                linkTag.setAttribute("href", webLink);
                                linkTag.click();
                            }*/
                            searchWrapper.classList.remove("active");
                        });
                    }

                    if (e.key === 'Escape') {
                        searchWrapper.classList.remove("active");
                    }
                } else {
                    searchWrapper.classList.remove("active"); //hide autocomplete box
                }
            }
        }
    }
    return searchWrapper.children[0];
}