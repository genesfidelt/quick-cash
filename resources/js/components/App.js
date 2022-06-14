import React from 'react';
//import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom';
import { Route, Redirect } from 'react-router'
import { useState, useEffect } from "react";

import Table from './company/Table';
import CompanyAdd from './company/CompanyAdd';
import UserAdd from './user/UserAdd';
import UserTable from './user/UserTable';
import UserEdit from './user/UserEdit';
import ConfigEdit from './config/ConfigEdit';
import LoanRequest from './loan/LoanRequest';
import LoanTable from './loan/LoanTable';
import LoanDetail from './loan/LoanDetail';

let path = window.location.pathname;
let pathwithparams = path.split('/');
let pathParam = pathwithparams[3];
if (pathwithparams.length > 3) {
    path = pathwithparams.pop();
    path = pathwithparams.join('/');
}

function App() {
    const [ident, setIdent] = useState({});
    useEffect(async () => {
        await axios.get('/get/uses').then(function (response) {
            if (response.data){
                setIdent(response.data)
                //user id
            }
        });
    }, []);

    function renderSwitch(param) {
        switch(param) {
            case '/company':
                return <Table ident={ident} pathParam={pathParam}/>;
            case '/user':
                return <UserTable ident={ident} pathParam={pathParam}/>;
            case '/company/add':
                return <CompanyAdd ident={ident} pathParam={pathParam}/>;
            case '/user/add':
                return <UserAdd ident={ident} pathParam={pathParam}/>;
            case '/user/edit':
                return <UserEdit ident={ident} pathParam={pathParam}/>;
            case '/config/edit':
                return <ConfigEdit ident={ident} pathParam={pathParam}/>
            case '/loan/request':
                return <LoanRequest ident={ident} pathParam={pathParam}/>
            case '/loan/employees':
                return <LoanTable ident={ident} pathParam={pathParam}/>
            case '/loan/detail':
                return <LoanDetail ident={ident} pathParam={pathParam}/>;
            default:
                return;
        }
    }

    return (
        <div className="container">
            <div className="row justify-content-center">
                { renderSwitch(path) }
            </div>
        </div>
    );
}

export default App;