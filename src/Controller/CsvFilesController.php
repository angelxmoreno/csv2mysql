<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * CsvFiles Controller
 *
 * @property \App\Model\Table\CsvFilesTable $CsvFiles
 * @method \App\Model\Entity\CsvFile[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CsvFilesController extends AppController
{
/**
* Index method
*
* @return void Renders view
*/
public function index()
{
$csvFiles = $this->paginate($this->CsvFiles);

$this->set(compact('csvFiles'));
}

/**
* View method
*
* @param string|null $id Csv File id.
* @return void Renders view
* @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
*/
public function view(?string $id = null)
{
$csvFile = $this->CsvFiles->get($id, [
'contain' => [],
]);

$this->set(compact('csvFile'));
}

/**
* Add method
*
* @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
*/
public function add()
{
$csvFile = $this->CsvFiles->newEmptyEntity();
if ($this->request->is('post')) {
$csvFile = $this->CsvFiles->patchEntity($csvFile, $this->request->getData());
if ($this->CsvFiles->save($csvFile)) {
$this->Flash->success(__('The csv file has been saved.'));

return $this->redirect(['action' => 'index']);
}
$this->Flash->error(__('The csv file could not be saved. Please, try again.'));
}
$this->set(compact('csvFile'));
}

/**
* Edit method
*
* @param string|null $id Csv File id.
* @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
* @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
*/
public function edit(?string $id = null)
{
$csvFile = $this->CsvFiles->get($id, [
'contain' => [],
]);
if ($this->request->is(['patch', 'post', 'put'])) {
$csvFile = $this->CsvFiles->patchEntity($csvFile, $this->request->getData());
if ($this->CsvFiles->save($csvFile)) {
$this->Flash->success(__('The csv file has been saved.'));

return $this->redirect(['action' => 'index']);
}
$this->Flash->error(__('The csv file could not be saved. Please, try again.'));
}
$this->set(compact('csvFile'));
}

/**
* Delete method
*
* @param string|null $id Csv File id.
* @return \Cake\Http\Response|null|void Redirects to index.
* @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
*/
public function delete(?string $id = null): ?\Cake\Http\Response
{
$this->request->allowMethod(['post', 'delete']);
$csvFile = $this->CsvFiles->get($id);
if ($this->CsvFiles->delete($csvFile)) {
$this->Flash->success(__('The csv file has been deleted.'));
} else {
$this->Flash->error(__('The csv file could not be deleted. Please, try again.'));
}

return $this->redirect(['action' => 'index']);
}
}
