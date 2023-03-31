<table class="table create-table">
    <tr>
        <th class="table-secondary create-table-item">ID</th>
        <td class="table-light">
            <input type="text" name="id" value="{{ $user->id ?? '' }}" disabled>
        </td>
    </tr>
    <tr>
        <th class="table-secondary create-table-item">
            <label for="last_name">姓</label>
        </th>
        <td class="table-light">
            <input type="text" name="last_name" class="@error('last_name') is-invalid @enderror" value="{{ old('last_name',$user->last_name ?? '') }}" {{ $readOnly ? ' disabled ' : '' }} id="last_name">
            @error('last_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </td>
    </tr>
    <tr>
        <th class="table-secondary create-table-item">姓(ふりがな)</th>
        <td class="table-light">
            <input type="text" name="last_name_kana" class="@error('last_name_kana') is-invalid @enderror" value="{{ old('last_name_kana',$user->last_name_kana ?? '') }}" {{ $readOnly ? ' disabled ' : '' }}>
            @error('last_name_kana')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </td>
    </tr>
    <tr>
        <th class="table-secondary create-table-item">名前</th>
        <td class="table-light">
            <input type="text" name="first_name" class="@error('first_name') is-invalid @enderror" value="{{ old('first_name' ,$user->first_name ?? '') }}" {{ $readOnly ? ' disabled ' : '' }}>
            @error('first_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </td>
    </tr>
    <tr>
        <th class="table-secondary create-table-item">名前(ふりがな)</th>
        <td class="table-light">
            <input type="text" name="first_name_kana" class="@error('first_name_kana') is-invalid @enderror" value="{{ old('first_name_kana' ,$user->first_name_kana ?? '') }}" {{ $readOnly ? ' disabled ' : '' }}>
            @error('first_name_kana')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </td>
    </tr>
    <tr>
        <th class="table-secondary create-table-item">都道府県</th>
        <td class="table-light">
            <select class="form-select w-50" name="prefecture" value="{{ old('prefecture' , $user->prefecture ?? '') }}" {{ $readOnly ? ' disabled ' : '' }}>
                @php
                $list = array(""=>'選択してください','北海道'=>'北海道','青森県'=>'青森県','岩手県'=>'岩手県','宮城県'=>'宮城県','秋田県'=>'秋田県','山形県'=>'山形県','福島県'=>'福島県','茨城県'=>'茨城県','栃木県'=>'栃木県','群馬県'=>'群馬県','埼玉県'=>'埼玉県','千葉県'=>'千葉県','東京都'=>'東京都','神奈川県'=>'神奈川県','新潟県'=>'新潟県','富山県'=>'富山県','石川県'=>'石川県','福井県'=>'福井県','山梨県'=>'山梨県','長野'=>'長野県','岐阜県'=>'岐阜県','静岡県'=>'静岡県','愛知県'=>'愛知県','三重県'=>'三重県','滋賀県'=>'滋賀県','京都府'=>'京都府','大阪府'=>'大阪府','兵庫県'=>'兵庫県','奈良県'=>'奈良県','和歌山県'=>'和歌山県','鳥取県'=>'鳥取県','島根県'=>'島根県','岡山県'=>'岡山県','広島県'=>'広島県','山口県'=>'山口県','徳島県'=>'徳島県','香川県'=>'香川県','愛媛県'=>'愛媛県','高知県'=>'高知県','福岡県'=>'福岡県','佐賀県'=>'佐賀県','長崎県'=>'長崎県','熊本県'=>'熊本県','大分県'=>'大分県','宮崎県'=>'宮崎県','鹿児島県'=>'鹿児島県','沖縄県'=>'沖縄県');
                $data='';

                foreach ($list as $key => $ken){
                    $data .= "<option value='". $key;
                    $data .= "'>". $ken. "</option>";
                }

                echo $data;
                @endphp
            </select>
        </td>
    </tr>
    <tr>
        <th class="table-secondary create-table-item">市区町村・番地</th>
        <td class="table-light"><input type="text" name="address1" value="{{ old('address1',$user->address1 ?? '') }}" {{ $readOnly ? ' disabled ' : '' }}></td>
    </tr>
    <tr>
        <th class="table-secondary create-table-item">建造物名・部屋番号</th>
        <td class="table-light"><input type="text" name="address2" value="{{ old('address2',$user->address2 ?? '') }}" {{ $readOnly ? ' disabled ' : '' }}></td>
    </tr>
    <tr>
        <th class="table-secondary create-table-item">メールアドレス</th>
        <td class="table-light">
            <input type="email" name="email" class="@error('email') is-invalid @enderror" value="{{ old('email',$user->email ?? '') }}" {{ $readOnly ? ' disabled ' : '' }}>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </td>
    </tr>
    <tr>
        <th class="table-secondary create-table-item">入社日</th>
        <td class="table-light">
            <input type="date" name="join_date" class="@error('join_date') is-invalid @enderror" value="{{ old('join_date' ,$user->join_date ?? '') }}" {{ $readOnly ? ' disabled ' : '' }}>
            @error('join_date')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </td>
    </tr>
    <tr>
        <th class="table-secondary create-table-item create-table-item-last">パスワード</th>
        <td class="table-light create-table-item-last"><input type="password" name="password" value="{{ old('password',$user->password ?? '') }}" {{ $readOnly ? ' disabled ' : '' }}></td>
    </tr>
</table>