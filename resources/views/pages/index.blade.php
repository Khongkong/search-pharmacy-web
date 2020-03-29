<!DOCTYPE html>
@extends('layouts.app')

@section('content')    
<main role="main">
    <div class="jumbotron">
        <div class="col-sm-8 mx-auto">
            <h1>全台藥局口罩資訊</h1>
            <p>武漢肺炎襲台，人人自危。為遏止國人搶購、囤積口罩的風潮，中央流行疫情指揮中心自2月6日開始口罩販售實名制，希望讓更多有需要的民眾買得到口罩，並讓資源利用公平及透明。</p>
            <p>因此，本網站提供你最新的藥局口罩資訊，希望能幫你及時找到藥局購買到口罩(๑•̀ω•́)ノ！</p>
            <hr>
            <form id="search" method="POST" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    {{-- <label for="choose-search" class="sr-only">搜尋地址</label> --}}
                    <select type="text" class="form-control mr-3" id="choose-search" placeholder="搜尋地址" required>
                        <option selected disabled value="">選擇搜尋方式</option>
                        <option value="name">找藥局店名</option>
                        <option value="address">找地址</option>
                    </select>
                    {{-- <label for="key-word" class="sr-only">關鍵字</label> --}}
                    <input type="text" class="form-control" id="key-query" placeholder="輸入關鍵字" required>
                </div>
                <button type="submit" class="btn btn-primary mb-2">確認</button>
            </form>
        </div>
    </div>
</main>
<script>
    $('#choose-search').on('change', function(){
        $('#key-query').attr("name", $(this).find(":selected").val());
    });
</script>
@endsection