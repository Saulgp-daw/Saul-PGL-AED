using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class Movimiento : MonoBehaviour
{
    Rigidbody body;
    Vector3 direccion;

    float speed = 1.0f;

    // Start is called before the first frame update
    void Start()
    {
        direccion = new Vector3(1.0f, 0.0f, 1.0f);
        body = GetComponent<Rigidbody>();
    }

    // Update is called once per frame
    void Update()
    {

    }

    void FixedUpdate()
    {
        float horizontal = Input.GetAxis("Horizontal");
        float vertical = Input.GetAxis("Vertical");
        if (vertical > 0)
        {
            direccion = new Vector3(0.0f, 0.0f, speed * 1.0f);
            body.AddForce(direccion, ForceMode.Impulse);
        }

        if (vertical < 0)
        {
            direccion = new Vector3(0.0f, 0.0f, speed * -1.0f);
            body.AddForce(direccion, ForceMode.Impulse);
        }

        if (horizontal > 0)
        {
            direccion = new Vector3(speed * 1.0f, 0.0f, 0.0f);
            body.AddForce(direccion, ForceMode.Impulse);
        }

        if (horizontal < 0)
        {
            direccion = new Vector3(speed * -1.0f, 0.0f, 0.0f);
            body.AddForce(direccion, ForceMode.Impulse);
        }

    }

    void OnTriggerEnter(Collider other)
    {
        if (other.gameObject.CompareTag("comida"))
        {
            other.gameObject.SetActive(false);
        }
    }
}
