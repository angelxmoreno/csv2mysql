<?php
declare(strict_types=1);

namespace App\Controller;

use App\Utility\RuntimeTable;
use App\Utility\TableAnalyzer;
use Cake\Datasource\Exception\RecordNotFoundException;

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
     * @throws RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $csvFile = $this->CsvFiles->get($id, [
            'contain' => [],
        ]);
        $analysis = new TableAnalyzer(RuntimeTable::loadTable($csvFile->table_name));
        $this->set(compact('csvFile', 'analysis'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Csv File id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null): ?\Cake\Http\Response
    {
        $this->request->allowMethod(['post', 'delete']);
        $csvFile = $this->CsvFiles->get($id);
        $tableName = $csvFile->table_name;
        if ($this->CsvFiles->delete($csvFile)) {
            RuntimeTable::removeTable($tableName);
            $this->Flash->success(__('The csv file has been deleted.'));
        } else {
            $this->Flash->error(__('The csv file could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
