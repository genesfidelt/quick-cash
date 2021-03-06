import axios from "axios";
import { forEach } from "lodash";
import { useState, useEffect } from "react";

export default function LoanDetail({ident, pathParam}) {
    const [loan, setLoan] = useState({});
    const [approver, setApprover] = useState("");
    const [acknowledger, setAcknowledger] = useState("");
    const [loanHistory, setLoanHistory] = useState([]);
    const [historylength, setHistoryLength] = useState(0);
    const [debtpermonth, setDebtpermonth] = useState(0);
    useEffect(async () => {
        await axios.get('/get/loan/detail/' + pathParam).then(function (response) {
            setLoan(response.data);
            console.log(response.data);
            if (response.data.approver === null) {
                setApprover(null);
            } else {
                setApprover(response.data.approver.name);
            }

            if (response.data.acknowledger === null) {
                setAcknowledger(null);
            } else {
                setAcknowledger(response.data.acknowledger.name);
            }
            
            setLoanHistory(response.data.history);
            setHistoryLength(response.data.historylength);
            setDebtpermonth(response.data.debtpermonth)
        });
    }, []);


    return (
        <div>
            <div>
                <b>Amount:</b> {loan.amount}
            </div>
            <div>
                <b>Date of Application:</b> {loan.dateofapplication}
            </div>
            <div>
                <b>Approved by:</b> {approver ? approver : 'Loan is not yet approved'}
            </div>
            <div>
                <b>Acknowledged by:</b> {acknowledger ? acknowledger : 'Loan is not yet acknowledged'}
            </div>
            <div>
                <b>Term in months:</b> {loan.term_in_months}
            </div>
            <div>
                <b>Interest rate:</b> {loan.rate}%
            </div>
            <div>
                <b>Total debt:</b> {loan.debt}
            </div>
                <table className="table table-hover">
                    <thead>
                    <tr>
                        <th>Amount to pay</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        {
                            historylength > 0 ? (
                                loanHistory.map(function(x,y) {
                                    return <tr>
                                        <td>{debtpermonth}</td>
                                        <td>{loan.amort_dates[y]}</td>
                                        <td>
                                        {
                                            x.is_paid === 1 ? (
                                                <p>Paid</p>
                                            ) : (
                                                <p>Not yet paid</p>
                                            )
                                        }
                                        </td>
                                        <td>
                                            {
                                                x.is_paid === 1 ? (
                                                    <p></p>
                                                ) : (
                                                    <a className="btn btn-info" href={"/pay/loan/" + x.id}>
                                                        Pay Loan
                                                    </a>
                                                )
                                            }
                                            
                                        </td>
                                    </tr>
                                })
                                
                            ) : (
                                <tr>
                                    <td>No data</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            )
                        }
                    </tbody>
                </table>
        </div>
    )
}