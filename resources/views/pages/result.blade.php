@if(isset($pharmacies))
<h2>搜尋結果：共{{count($pharmacies)}}筆</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">藥局名稱</th>
            <th scope="col">地址</th>
            <th scope="col">電話</th>
            <th scope="col">成人口罩數量</th>
            <th scope="col">兒童口罩數量</th>
        </tr>
    </thead>
    <tbody id="table-body"></tbody>
</table>
<hr>
<nav aria-label="Page navigation">
    <ul id="wrapper" class="pagination justify-content-end">
    </ul>
  </nav>
<script>
    const pharmacies = {!! json_encode($pharmacies) !!};
    const state = {
        'querySet': pharmacies,
        'page': 1,
        'limit': 10,
        'window': 5
    };
    buiildTable() 

    function pagination (querySet, page, limit) {
        const trimStart = (page - 1) * limit;
        const trimEnd = trimStart + limit;
        const trimmedData = querySet.slice(trimStart, trimEnd);
        const pages = Math.ceil(querySet.length / limit);
        return {
            'querySet': trimmedData,
            'pages': pages
        };
    }
    function pageButtons (pages) {
        let maxLeft = state.page - Math.floor(state.window / 2);
        let maxRight = state.page + Math.floor(state.window / 2);
        if(maxLeft < 1) {
            maxLeft = 1;
            maxRight = state.window;
        }
        if(maxRight > pages) {
            maxLeft = (maxLeft > 1)? pages - (state.window - 1): 1;
            maxRight = pages;
        }
        let wrapper = document.getElementById('wrapper');
        // if(state.pharmacies !== undefined){
            wrapper.innerHTML = '';
            for (let page = maxLeft; page <= maxRight; page++) {
                if(page !== state.page){
                    wrapper.innerHTML += `<li class="page page-item page-link" style="cursor: pointer">${page}</li>`;
                }else{
                    wrapper.innerHTML += `<li class="page page-item disabled" style="cursor: default"><a class="page-link"><b>${page}</b></a></li>`;
                }
            }
            if(state.page !== 1) {
                wrapper.innerHTML = `<li class="page page-item page-link" style="cursor: pointer">上一頁</li>` + wrapper.innerHTML;
            }
            if(state.page !== pages) {
                wrapper.innerHTML += `<li class="page page-item page-link" style="cursor: pointer">下一頁</li>`;
            }
    
            $('.page').on('click', function() {
                $('#table-body').empty();
                let whichPage = $(this).text();
                if(whichPage == '上一頁'){
                    state.page = parseInt(state.page) - 1;    
                }else if(whichPage == '下一頁'){
                    state.page = parseInt(state.page) + 1;    
                }else{
                    state.page = parseInt(whichPage);
                }
                buiildTable();
            })
        // }
    }

    function buiildTable() {
        const table = $('#table-body');
        let data = pagination(state.querySet, state.page, state.limit);
        list = data.querySet;
        for (let i in list) {
            let row = `<tr>
                <th scope="row">${list[i].id}</th>
                <td>${list[i].name}</td>
                <td>${ list[i].address }</td>
                <td>${ list[i].phone }</td>
                <td>${ list[i].mask_adult }</td>
                <td>${ list[i].mask_child }</td>
            </tr>`;
            table.append(row);
        }
        pageButtons (data.pages);
    }
</script>
@endif