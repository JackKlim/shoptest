<?php

	class ProductController implements IController {

		public function showAction() {
			$category = (!empty($_GET['category'])) ? $_GET['category'] : null;
			$category = ((int) $category) ? (int) $category : null;

			$products = $this->getProductsByCategory($category);
			
			$this->showProducts($products);

		}

		public function productAction() {
			echo "Мы в productAction класса ProductController =)";
		}

		private function getProductsByCategory($category) {
			$noCategory = function() {
				$conn = DBConn::getInstance()->getConn();
				$select = "select * from product";
				$res = $conn->query($select);
				return $res->fetchAll(PDO::FETCH_ASSOC);
			};
			$yesCategory = function($category) {
				$conn = DBConn::getInstance()->getConn();
				$selectAllCategories = "select id from category where categor_id = :id";
				$stmt = $conn->prepare($selectAllCategories);
				$stmt->execute([":id" => $category]);
				
				$ids = [$category];
				$cnt = "?,";
				while($r = $stmt->fetch(PDO::FETCH_NUM)) {
					$ids[] = (int) $r[0];
					$cnt .= "?,";
				}

				$selectProd = "select p.id,p.name,c.name as categor_id,p.producer_id,p.measur_id from product as p,  category as c
				               where p.categor_id = c.id AND p.categor_id in(".trim($cnt,",").")";
				$stmt = $conn->prepare($selectProd);
				$stmt->execute($ids);
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			};

			return (!$category) ? $noCategory() : $yesCategory($category) ;
		}

		private function showProducts($products) {
			echo "<table>";
			echo "<tr>";
			echo "<th>id</th>";
			echo "<th>name</th>";
			echo "<th>categor_id</th>";
			echo "<th>producer_id</th>";
			echo "<th>measur_id</th>";
			echo "</tr>";
			foreach ($products as $product) {
				echo "<tr>";
				echo "<td>" . $product["id"] . "</td>";
				echo "<td>" . $product["name"] . "</td>";
				echo "<td>" . $product["categor_id"] . "</td>";
				echo "<td>" . $product["producer_id"] . "</td>";
				echo "<td>" . $product["measur_id"] . "</td>";
				echo "</tr>";
			}
			echo "</table>";
		}

	}