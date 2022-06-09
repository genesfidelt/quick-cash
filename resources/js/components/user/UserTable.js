import axios from "axios";
import { forEach } from "lodash";
import { useState, useEffect } from "react";
import UserTableRow from './UserTableRow';

export default function UserTable() {
    const [isLoading, setLoading] = useState(true);
    const [data, setData] = useState({});
    useEffect(async () => {
        await axios.get('/get/user/list').then(response => {
            setData(response.data);
            setLoading(false);
        });
    }, []);
  
    if (isLoading) {
        return <div></div>;
    }

    return (
        <div className="container">
        <div className="row justify-content-center">
            <div className="col-md-8">
                <div className="col-md-4">
                    <a className="btn btn-info" href="/user/add">Add User</a>
                </div>
                <div className="card">
                    <table className="table table-hover">
                        <thead>
                            <tr>
                            <th scope="col" width="100px">Name</th>
                            <th scope="col" width="100px">E-mail</th>
                            <th scope="col" width="100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <UserTableRow
                                data={data}
                                setData={setData}
                            />
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    );
}