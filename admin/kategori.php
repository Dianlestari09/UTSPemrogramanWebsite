<?php
include '../config/koneksi.php';
include 'header.php';

// Aktifkan error reporting untuk development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Konfigurasi pagination
$limit = 10;
$noPage = isset($_GET['p']) ? (int)$_GET['p'] : 1;
$offset = ($noPage - 1) * $limit;

// Query dengan prepared statement
$sql = "SELECT id, name, description FROM category ORDER BY id DESC LIMIT ?, ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ii", $offset, $limit);
$stmt->execute();
$result = $stmt->get_result();

// Hitung total data
$count_sql = "SELECT COUNT(*) as total FROM category";
$count_result = $mysqli->query($count_sql);
$total_row = $count_result->fetch_assoc();
$total_rec_num = $total_row['total'];
$total_page = ceil($total_rec_num / $limit);
?>

<div class="container-fluid body">
	<div class="row">
		<div class="col-lg-2 sidebar">
			<?php include 'sidebar.php'; ?>
		</div>
		<div class="col-lg-10 main-content">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<h2 class="page-header"><i class="fa fa-folder-o"></i> Manajemen Kategori</h2>
						</div>
					</div>

					<!-- Form Tambah Kategori -->
					<div class="row">
						<div class="col-md-4">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title">Tambah Kategori Baru</h3>
								</div>
								<div class="panel-body">
									<form method="POST" action="aksi-kat.php?act=tambah">
										<div class="form-group">
											<label>Nama Kategori</label>
											<input type="text" name="name" class="form-control" required>
										</div>
										<div class="form-group">
											<label>Deskripsi</label>
											<textarea name="description" class="form-control" rows="3"></textarea>
										</div>
										<button type="submit" class="btn btn-primary">
											<i class="fa fa-save"></i> Simpan
										</button>
									</form>
								</div>
							</div>
						</div>

						<!-- Daftar Kategori -->
						<div class="col-md-8">
							<div class="table-responsive">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th width="10%">ID</th>
											<th width="30%">Nama Kategori</th>
											<th width="40%">Deskripsi</th>
											<th width="20%" class="text-center">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php if ($result->num_rows == 0): ?>
											<tr>
												<td colspan="4" class="text-center">Tidak ada data kategori</td>
											</tr>
										<?php else: ?>
											<?php while ($row = $result->fetch_assoc()): ?>
												<tr>
													<td><?= $row['id'] ?></td>
													<td><?= htmlspecialchars($row['name']) ?></td>
													<td><?= htmlspecialchars($row['description']) ?></td>
													<td class="text-center">
														<a href="edit-kategori.php?id=<?= $row['id'] ?>"
															class="btn btn-sm btn-warning"
															title="Edit">
															<i class="fa fa-edit"></i>
														</a>
														<a href="aksi-kat.php?act=hapus&id=<?= $row['id'] ?>"
															class="btn btn-sm btn-danger"
															title="Hapus"
															onclick="return confirm('Yakin menghapus kategori ini?')">
															<i class="fa fa-trash"></i>
														</a>
													</td>
												</tr>
											<?php endwhile; ?>
										<?php endif; ?>
									</tbody>
								</table>
							</div>

							<!-- Pagination -->
							<?php if ($total_page > 1): ?>
								<nav aria-label="Page navigation">
									<ul class="pagination">
										<?php if ($noPage > 1): ?>
											<li>
												<a href="kategori.php?p=<?= ($noPage - 1) ?>" aria-label="Previous">
													<span aria-hidden="true">&laquo;</span>
												</a>
											</li>
										<?php endif; ?>

										<?php
										// Tampilkan 5 halaman sekitar current page
										$start = max(1, $noPage - 2);
										$end = min($total_page, $noPage + 2);

										if ($start > 1) {
											echo '<li><a href="kategori.php?p=1">1</a></li>';
											if ($start > 2) echo '<li class="disabled"><span>...</span></li>';
										}

										for ($i = $start; $i <= $end; $i++) {
											$active = ($i == $noPage) ? 'active' : '';
											echo '<li class="' . $active . '"><a href="kategori.php?p=' . $i . '">' . $i . '</a></li>';
										}

										if ($end < $total_page) {
											if ($end < $total_page - 1) echo '<li class="disabled"><span>...</span></li>';
											echo '<li><a href="kategori.php?p=' . $total_page . '">' . $total_page . '</a></li>';
										}
										?>

										<?php if ($noPage < $total_page): ?>
											<li>
												<a href="kategori.php?p=<?= ($noPage + 1) ?>" aria-label="Next">
													<span aria-hidden="true">&raquo;</span>
												</a>
											</li>
										<?php endif; ?>
									</ul>
								</nav>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

