<?php
    $hotels = [
        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],
    ];
    $parkingFilter = isset($_GET['park']) && $_GET['park'] === '1' ? true : false;
    $vote_filter = isset($_GET['vote']) ? intval($_GET['vote']) : 0;

    $filteredHotels = $hotels;
    if ($parkingFilter) {
        $hotelsWithPark = [];
        foreach($filteredHotels as $hotel) {
            if ($hotel['parking'] === true) {
                $hotelsWithPark[] = $hotel;
            }
        }
        $filteredHotels = $hotelsWithPark;
    }

    if($vote_filter > 0) {
        $hotelsFilteredByVote = [];
    
        foreach($filteredHotels as $hotel) {
            if($hotel['vote'] >= $vote_filter) {
                $hotelsFilteredByVote[] = $hotel;
            }
        }
    
        $filteredHotels = $hotelsFilteredByVote;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Hotels</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrizione</th>
                    <th>Parcheggio</th>
                    <th>Voto</th>
                    <th>Distanza dal centro</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($filteredHotels as $hotel) { ?>
                    <tr>
                        <td><?php echo $hotel['name']; ?></td>
                        <td><?php echo $hotel['description']; ?></td>
                        <td><?php echo $hotel['parking'] ? 'Si' : 'No'; ?></td>
                        <td><?php echo $hotel['vote']; ?></td>
                        <td><?php echo $hotel['distance_to_center']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <form method="GET">
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="park" name="park" value="1">
                <label class="form-check-label" for="park">Con parcheggio</label>
            </div>
            <div class="mb-3">
                <label for="vote" class="form-label">Voto</label>
                <select id="vote" class="form-select" name="vote">
                    <option <?php echo $vote_filter === 0 ? 'selected' : '' ?> value="0">Tutti</option>
                    <option <?php echo $vote_filter === 1 ? 'selected' : '' ?> value="1">Almeno 1</option>
                    <option <?php echo $vote_filter === 2 ? 'selected' : '' ?> value="2">Almeno 2</option>
                    <option <?php echo $vote_filter === 3 ? 'selected' : '' ?> value="3">Almeno 3</option>
                    <option <?php echo $vote_filter === 4 ? 'selected' : '' ?> value="4">Almeno 4</option>
                    <option <?php echo $vote_filter === 5 ? 'selected' : '' ?> value="5">Almeno 5</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>