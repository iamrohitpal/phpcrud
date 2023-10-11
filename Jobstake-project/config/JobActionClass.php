<?php
include "AutoloadClass.php";

class JobActionClass extends DbConnection
{
    public function create($request)
    {
        $file_name = strtotime('now') . '-' . $_FILES['image']['name'];
        move_uploaded_file($_FILES["image"]["tmp_name"], '../upload_images/' . $file_name);
        unset($request['submit_job'], $request['image']);
        $arrayMergeData = array_merge($request, ['image' => $file_name, 'publish' => '0']);
        $data = $this->insert('job_post', $arrayMergeData);
        if ($data) {
            $returnData = $this->getData('job_post', ['where' => ['id' => $data], 'return_type' => 'single']);
            return [
                'success' => true,
                'data' => $returnData
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Data Not Found!'
            ];
        }
    }

    public function showData()
    {
        $data = $this->getData('job_post', []);
        if ($data) {
            return [
                'success' => true,
                'data' => $data
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Data Not Found!'
            ];
        }
    }

    public function showUpdate($id)
    {
        $data = $this->getData('job_post', ['where' => ['id' => $id], 'return_type' => 'single']);
        if ($data) {
            return [
                'success' => true,
                'data' => $data
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Data Not Found!'
            ];
        }
    }

    public function updateData($request)
    {
        $file_name = strtotime('now') . '-' . $_FILES['image']['name'];
        move_uploaded_file($_FILES["image"]["tmp_name"], '../upload_images/' . $file_name);
        $id = $request['id'];
        unset($request['update_job'], $request['image'], $request['id']);
        $arrayMergeData = array_merge($request, ['image' => $file_name]);
        $data = $this->update('job_post', $arrayMergeData, ['id' => $id]);
        if ($data) {
            $returnData = $this->getData('job_post', ['where' => ['id' => $id], 'return_type' => 'single']);
            return [
                'success' => true,
                'data' => $returnData
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Data Not Found!'
            ];
        }
    }

    public function changeStatusPublish($id)
    {
        $data = $this->update('job_post', ['publish' => '1'], ['id' => $id]);
        if ($data) {
            $returnData = $this->getData('job_post', ['where' => ['id' => $id], 'return_type' => 'single']);
            return [
                'success' => true,
                'data' => $returnData
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Data Not Found!'
            ];
        }
    }

    public function changeStatusUnpublish($id)
    {
        $data = $this->update('job_post', ['publish' => '0'], ['id' => $id]);
        if ($data) {
            $returnData = $this->getData('job_post', ['where' => ['id' => $id], 'return_type' => 'single']);
            return [
                'success' => true,
                'data' => $returnData
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Data Not Found!'
            ];
        }
    }
}