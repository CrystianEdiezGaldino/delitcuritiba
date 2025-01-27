<?php
// Configurações de conexão com o banco de dados
$servername = "24.152.39.108";
$username = "site";
$password = 'F5uR9grsfalodgrsdsoh$XnrROPK!TEhgdseRcOFu#3MZO@HKegMt3Vnqc@'; // Substitua com sua senha
$dbname = "site_aika"; // Substitua com o nome do seu banco de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consultar dados
$sql = "SELECT * FROM `mails_items` where mail_id = ". intval($_GET['id']);
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    // Salvar dados em um array
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
$conn->close();
$i = 0;
?>

<table id="dataTable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Item ID</th>
            <th>Nome Item</th>
            <th>Quantidade</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row): ?>
            
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['item_id']); ?></td>
                <td id="itemLabel<?php echo $i?>">
                    <script>
                        var itemId = <?php echo json_encode($row['item_id']); ?>;
                        var label = getLabelById(itemId);
                        document.getElementById('itemLabel<?php echo $i?>').innerText = label;
                    </script>
                </td>
                <td><?php echo htmlspecialchars($row['refine']); ?></td>
            </tr>
            <?php
                $i= $i+1;
            ?>
        <?php endforeach; ?>
    </tbody>
</table>

