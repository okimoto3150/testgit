@extends('layouts.app')
@section('content')
<main>
    <div class="wrap">
        <form action="{{url('/device-check')}}" method="post" class="device-form">
            <h2>主端末</h2>
            <div>
                <ul>
                    <li>
                        <label><input type="radio" name="type" checked="checked">スマートフォン</label>
                    </li>
                    <li>
                        <label><input type="radio" name="type">タブレット</label>
                    </li>
                    <li>
                        <label><input type="radio" name="type">その他</label>
                    </li>
                </ul>
            </div>
            <table>
                <tr>
                    <th>メーカー</th>
                    <td><input type="text"></td>
                    <th>機種</th>
                    <td><input type="text"></td>
                </tr>
                <tr>
                    <th>キャリア</th>
                    <td><input type="text"></td>
                    <th>容量</th>
                    <td><input type="text"></td>
                </tr>
                <tr>
                    <th>シリアル番号</th>
                    <td><input type="text"></td>
                    <th>IMEI</th>
                    <td><input type="text"></td>
                </tr>
                <tr>
                    <th>購入日</th>
                    <td><input type="text"></td>
                </tr>
                <tr>
                    <th>購入金額</th>
                    <td><input type="text"></td>
                </tr>
            </table>
            <input type="submit" name="submit" value="入力内容確認" class="device__btn" id="submit">
        </form>
        <button class="device__btn"><a href="{{url('/device-check')}}">入力内容確認</a></button>
    </div>
</main>
@endsection