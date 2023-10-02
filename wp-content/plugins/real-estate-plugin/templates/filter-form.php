<form id="real-estate-filter-form">
    <label for="district">Район:</label>
    <select name="district" id="district">
        <option value="">Все районы</option>
        <option value="district1">Район 1</option>
        <option value="district2">Район 2</option>
        <option value="district3">Район 3</option>
    </select>

    <label for="building-type">Тип строения:</label>
    <select name="building_type" id="building-type">
        <option value="">Любой тип</option>
        <option value="panel">Панель</option>
        <option value="brick">Кирпич</option>
        <option value="foam">Пеноблок</option>
    </select>

    <label for="min-floors">Мин. этажей:</label>
    <input type="number" name="min_floors" id="min-floors" min="1" max="20">

    <label for="max-floors">Макс. этажей:</label>
    <input type="number" name="max_floors" id="max-floors" min="1" max="20">

    <input type="submit" value="Поиск">
</form>
