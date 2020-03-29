<div class="result">
<h2 id="search-result"></h2>
<table class="table table-striped">
    <thead id="table-head" style="display: none">
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
    <ul id="wrapper" class="pagination">
    </ul>
</nav>
<div class="loader" style="display:none">
    <div class="circle"></div>
    <div class="circle"></div>
</div>
</div>
<script src="{{ asset('js/renderResult.js') }}"></script>
