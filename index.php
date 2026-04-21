<?php
$employees = [
    ['id' => 'E001', 'name' => '山田 太郎', 'department' => '営業部'],
    ['id' => 'E002', 'name' => '佐藤 花子', 'department' => '総務部'],
    ['id' => 'E003', 'name' => '鈴木 一郎', 'department' => '開発部'],
    ['id' => 'E004', 'name' => '高橋 美咲', 'department' => '開発部'],
    ['id' => 'E005', 'name' => '伊藤 健', 'department' => '人事部'],
    ['id' => 'E006', 'name' => '渡辺 直子', 'department' => '営業部'],
    ['id' => 'E007', 'name' => '中村 翔', 'department' => '経理部'],
    ['id' => 'E008', 'name' => '小林 愛', 'department' => '広報部'],
    ['id' => 'E009', 'name' => '加藤 恒一', 'department' => '開発部'],
    ['id' => 'E010', 'name' => '吉田 真由', 'department' => '品質保証部'],
];
?>
<!doctype html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>社員一覧検索</title>
  <style>
    body { font-family: sans-serif; margin: 24px; }
    .search-box { margin-bottom: 12px; }
    input, button { padding: 6px 10px; font-size: 14px; }
    table { border-collapse: collapse; width: 100%; max-width: 720px; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    th { background: #f5f5f5; }
    #resultCount { margin: 10px 0; font-weight: 600; }
  </style>
</head>
<body>
  <h2>社員一覧検索</h2>

  <div class="search-box">
    <label for="nameInput">社員名：</label>
    <input id="nameInput" type="text" placeholder="例: 山田">
    <button id="searchButton" type="button">検索</button>
  </div>

  <div id="resultCount"></div>

  <table>
    <thead>
      <tr>
        <th>社員ID</th>
        <th>社員名</th>
        <th>部署</th>
      </tr>
    </thead>
    <tbody id="employeeTableBody"></tbody>
  </table>

  <script>
    const employees = <?php echo json_encode($employees, JSON_UNESCAPED_UNICODE); ?>;

    function renderTable(list) {
      const tbody = document.getElementById('employeeTableBody');
      const count = document.getElementById('resultCount');
      tbody.innerHTML = list.map(emp => `
        <tr>
          <td>${emp.id}</td>
          <td>${emp.name}</td>
          <td>${emp.department}</td>
        </tr>
      `).join('');

      const keyword = document.getElementById('nameInput').value.trim();
      const countList = keyword
        ? employees.filter(emp => emp.name.includes(keyword))
        : employees;
      count.textContent = `検索結果：${countList.length}件`;
    }

    function searchEmployees() {
      const keyword = document.getElementById('nameInput').value.trim().toLowerCase();
      const filtered = keyword
        ? employees.filter(emp => emp.name.toLowerCase().includes(keyword))
        : employees;
      renderTable(filtered);
    }

    document.getElementById('searchButton').addEventListener('click', searchEmployees);
    renderTable(employees);
  </script>
</body>
</html>
